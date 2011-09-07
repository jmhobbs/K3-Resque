<?php

	abstract class Kohana_Controller_Resque extends Controller_Template {

		public $template = 'resque/template';
		public $subnav   = array();

		public function before () {
			parent::before();

			$this->content = View::factory( 'resque/' . Request::current()->action() );
			$this->template->bind( 'content', $this->content );

			$this->title = ucwords( Request::current()->action() );
			$this->template->bind( 'title', $this->title );

			$this->template->bind( 'subnav', $this->subnav );

			$this->resque = new Resque();
		}

		public function action_index () {
			$this->content->queues  = array();
			foreach( $this->resque->queues() as $queue ) {
				$this->content->queues[$queue] = array(
					'size' => $this->resque->queue_size( $queue ),
				);
			}
			$this->content->failed = $this->resque->failed_queue_size();

			$this->content->workers = array();
			foreach( $this->resque->workers() as $worker ) {
				$this->content->workers[$worker] = array(
					'working' => $this->resque->working( $worker ),
				);
			}
		}

		public function action_stats ( $section = 'resque' ) {
			$this->content->section = $section;
			
			$this->subnav = array(
				'resque' => '/stats/resque/',
				'redis'  => '/stats/redis/',
				'keys'   => '/stats/keys/'
			);

			if( $section == 'resque' ) {
				$this->content->processed = $this->resque->total_processed();
				$this->content->failed = $this->resque->total_failed();
				$this->content->workers = count( $this->resque->workers() );
			}

		}

	}

