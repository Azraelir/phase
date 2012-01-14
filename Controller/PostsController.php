<?php

App::uses('AppController', 'Controller');

class PostsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * User the application view class
 *
 * @var string
 */
    public $viewClass = 'Phase';

    public function archives() {
        if ($this->params->params['ext'] === 'xml') {
            $posts = $this->Post->findAll(20);
            $this->viewPath = 'Posts/xml';
        } else {
            $posts = $this->Post->findAll();
        }

        $this->set(compact('posts'));
    }

    public function home() {
        $posts = $this->Post->findAll(6);

        $latest = array_shift($posts);
        $this->set(compact('posts', 'latest'));
    }

/**
 * View a single post
 *
 * @param string $year
 * @param string $month
 * @param string $day
 * @param string $slug
 */
	public function viewDated($year = '', $month = '', $day = '', $slug = '') {
		if (!$year) {
			$this->redirect('/');
		}

        $this->set('postDate', mktime(0, 0, 0, $month, $day, $year));
        if (file_exists(Configure::read('PhasePosts') . "$year/$month/$day/$slug.md")) {
		    return $this->render("$year/$month/$day/$slug");
        }
		$this->render("$year-$month-$day-$slug");
	}

/**
 * View a something in the posts folder
 *
 * @param mixed What page to display
 */
	public function view() {
		$path = func_get_args();
		if (!$path) {
			$this->redirect('/');
		}

		$this->render(implode('/', $path));
	}
}
