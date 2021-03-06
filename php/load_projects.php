#!/usr/bin/php

<?php

	include_once 'db_connect.php';
	include_once 'Parsedown.php';
	
	//adding projects from CSV
	echo( "\nLoading projects from CSV:\n" );
	$db->query( "DELETE FROM projects" );
	$csv = csv_to_array( 'data/text/projects.csv' );
	
	foreach( $csv as $row )
	{	
		$query = 'INSERT INTO projects ';
		$cols = '( ';
		$vals = ' VALUES (';
		
		foreach( $row as $key => $value )
		{
			if( $value != '' )
			{
				$cols .= $key . ', ';
				if( $key == 'featured' )
				{
					$vals .= $value . ', ';
				}
				else
				{
					$vals .= "'" . SQLite3::escapeString( $value ) . "', ";
				}
			}
		}
		
		$query .= substr( $cols, 0, -2 ) . " )" . substr( $vals, 0, -2 ) . " )";
		$db->query( $query );
		$title = $row[ 'title' ];
		echo( "   $title\n" );
	}

	//adding feature text
	echo( "\nLoading feature text:\n" );
	$files = scandir( dirname(__FILE__) . '/../data/text/highlighted/' );
	foreach( $files as $f )
	{
		if( preg_match( "/\\.md$/u", $f ) )
		{
			$text = file_get_contents( dirname(__FILE__) . "/../data/text/highlighted/$f" );
			$result = Parsedown::instance()->parse( $text );
		
			$matches = array();
			preg_match_all( "/(?<=<\/h2>\\n<p>).*?(?=<\\/p>)/uis", $result, $matches );
			
			$id = preg_replace( "/\\.md$/u", "", $f );
			
			$query = "INSERT OR REPLACE INTO content ( id, intro, data, design, code ) VALUES ( '" . $id . "', '" . SQLite3::escapeString( $matches[ 0 ][ 0 ] ) . "', '" . SQLite3::escapeString( $matches[ 0 ][ 1 ] ) . "', '" . SQLite3::escapeString( $matches[ 0 ][ 2 ] ) . "', '" . SQLite3::escapeString( $matches[ 0 ][ 3 ] ) . "' )";
			
			$db->query( $query );
			
			echo( "   $id\n" );
		}
	}
	
	//adding big images
	echo( "\nLoading slideshow images:\n" );
	$files = scandir( dirname(__FILE__) . '/../data/media/slideshow/' );
	foreach( $files as $f )
	{
		if( preg_match( "/\\.png$/u", $f ) )
		{
			$image = file_get_contents( dirname(__FILE__) . "/../data/media/slideshow/$f" );
			$matches = array();
			
			preg_match_all( "/(?<=-)[0-9]*/u", $f, $matches );
			
			$id = preg_replace( "/-.*\\.png$/u", "", $f );
			
			$query = $db->prepare( "INSERT OR REPLACE INTO images ( id, image, x, y ) VALUES( ?, ?, ?, ? )" );
			$query->bindValue( 1, $id, SQLITE3_TEXT );
			$query->bindValue( 2, $image, SQLITE3_BLOB );
			$query->bindValue( 3, $matches[ 0 ][ 0 ], SQLITE3_INTEGER );
			$query->bindValue( 4, $matches[ 0 ][ 1 ], SQLITE3_INTEGER );
			$query->execute();
			
			echo( "   $id\n" );
		}
	}
	
	//adding feature slideshow
	echo( "\nLoading features slideshow:\n" );
	$files = scandir( dirname(__FILE__) . '/../data/media/features/' );
	foreach( $files as $f )
	{
		if( is_dir( dirname(__FILE__) . "/../data/media/features/$f" ) && preg_match( "/[a-z].*/u", $f ) )
		{
			
			$text = file_get_contents( dirname(__FILE__) . "/../data/text/features/$f.md" );
			$title = array();
			$caption = array();
			
			preg_match_all( "/(?<=### ).*/u", $text, $title );
			preg_match_all( "/^[^#\\n].*/um", $text, $caption );
			
			$db->query( "DELETE FROM features WHERE project = '$f'" );
			
			echo( "   $f - " );
			
			$sub = scandir( dirname(__FILE__) . "/../data/media/features/$f" );
			foreach( $sub as $s )
			{
				if( preg_match( "/\\.png$/u", $s ) )
				{
					$image = file_get_contents( dirname(__FILE__) . "/../data/media/features/$f/$s" );
					$id = intval( preg_replace( "/-.*\\.png$/u", "", $s ) );
					$query = $db->prepare( "INSERT INTO features ( project, step, title, text, image ) VALUES( ?, ?, ?, ?, ? )" );
					$query->bindValue( 1, $f, SQLITE3_TEXT );
					$query->bindValue( 2, $id, SQLITE3_INTEGER );
					$query->bindValue( 3, $title[ 0 ][ $id ], SQLITE3_TEXT );
					$query->bindValue( 4, $caption[ 0 ][ $id ], SQLITE3_TEXT );
					$query->bindValue( 5, $image, SQLITE3_BLOB );
					$query->execute();
					
					echo( " $id" );
				}
			}
			echo( "\n" );
		}
	}

	//adding portfolio briefs
	echo( "\nLoading portfolio briefs:\n" );
	$text = file_get_contents( dirname(__FILE__) . "/../data/text/portfolio_brief.md" );
	$result = Parsedown::instance()->parse( $text );
	
	$ids = array();
	$text = array();
	preg_match_all( "/(?<=\\<h2\\>).*(?=\\<\\/h2\\>)/u", $result, $ids );
	preg_match_all("/(?<=\\<p\\>).*(?=\\<\\/p\\>)/u", $result, $text );
	
	foreach( $ids[ 0 ] as $i => $id )
	{
		$db->query( "INSERT OR REPLACE INTO content ( id, intro ) VALUES( '" . $id . "', '" . SQLite3::escapeString( $text[ 0 ][ $i ] ) . "')" );
		echo( "   $id\n" );
	}
	
	function csv_to_array( $filename='', $delimiter=',' )
    {
        if( !file_exists( $filename ) || !is_readable( $filename ) ) return false;

        $header = NULL;
        $data = array();
        if( ( $handle = fopen( $filename, 'r' ) ) !== FALSE )
        {
            while( ( $row = fgetcsv( $handle, 1000, $delimiter ) ) !== FALSE )
            {
                if( !$header )
                    $header = $row;
                else
                    $data[] = array_combine( $header, $row );
            }
            fclose( $handle );
        }
        return $data;
    }
?>