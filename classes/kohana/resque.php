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

			public function queues () {
				return $this->redis->smembers( 'resque:queues' );
			}

			public function queue_size ( $queue ) {
				return $this->redis->llen( 'resque:queue:' . $queue );
			}

			public function failed_queue_size () {
				return $this->redis->llen( 'resque:failed' );
			}

			public function workers () {
				return $this->redis->smembers( 'resque:workers' );
			}

			public function working ( $worker ) {
				return ( null != $this->redis->get( 'resque:worker:' . $worker ) );
			}

			public function stat ( $name ) {
				return $this->redis->get( 'resque:stat:' . $name );
			}

			public function total_processed () {
				return $this->stat( 'processed' );
			}

			public function total_failed () {
				return $this->stat( 'failed' );
			}

	}

