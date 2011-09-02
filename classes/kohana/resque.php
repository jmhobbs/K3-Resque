<?php

	require_once Kohana::find_file( 'vendor', 'redisent/redisent' );

	/*
		$resque = new Resque();
		$resque->enqueue( 'test', 'RedisClass', 5 );
	*/

	class Kohana_Resque {

			public function __construct ( $server = "localhost", $port = 6379 ) {
					$this->redis = new redisent\Redis( $server, $port );
			}
			
			public function enqueue ( $queue, $class, $args = null ) {

					if( is_null( $args ) ) { 
						$args = array();
					}
					else if( ! is_array( $args ) ) { 
						$args = array( $args );
					}

					$this->redis->rpush( 
						"resque:queue:{$queue}", 
						json_encode( array(
							'class' => $class,
							'args'  => $args,
						) )
					);

			}
			
	}

