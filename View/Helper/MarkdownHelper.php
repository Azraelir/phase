<?php

App::uses('AppHelper', 'View/Helper');
App::import('Vendor', 'Markdown/Markdown');

class MarkdownHelper extends AppHelper {

    /**
     * settings
     */
    public $settings = array();

    /**
     * defaultSettings
     */
    protected $defaultSettings = array(
        'autoInitialize' => true,
        'run' => 'afterRender'
    );

    /**
     * parser instance
     */
    protected $parser;

    /**
     * __construct
     *
     * @param View $View
     * @param array $settings
     */
	public function __construct(View $View, $settings = array()) {
        $this->settings = $this->defaultSettings + $settings;
        $this->parser = new PhaseMarkdownParser();
        if (!empty($View->request->params['ext'])) {
            $ext = $View->request->params['ext'];
            if ($ext !== 'html') {
                $this->settings['run'] = 'never';
            }
        }
        if ($this->settings['autoInitialize']) {
            $this->initialize();
        }
        return parent::__construct($View, $settings);
    }

    /**
     * afterRender
     *
     * @param mixed $filename
     */
    public function afterRender($filename) {
        if ($this->settings['run'] !== 'afterRender') {
            return;
        }

        $this->_View->output = $this->process($this->_View->output);
    }

    /**
     * initialize
     *
     * Setup predefined variables on the parser instance
     *
     */
    public function initialize() {
        if (file_exists(APP . 'Config/Markdown.php')) {
            Configure::load('Markdown');
        }
        $this->parser->initialize(Configure::read('Markdown'));
    }

    /**
     * process
     *
     * @param string $input
     */
    public function process($input = '') {
        return $this->parser->transform($input);
    }

    public function getHeaders() {
        return $this->parser->getHeaders();
    }

    /**
     * setSection
     *
     * @param mixed $value
     */
    public function setSection($value = 'section') {
        $this->parser->setSection($value);
    }
}

/**
 * PhaseMarkdownParser
 *
 * Overridden to inject automatic header anchor links
 */
class PhaseMarkdownParser extends MarkdownExtra_Parser {

    /**
     * headerIds
     *
     * Stack of ids already used in header links
     */
    protected $headerIds = array();

    /**
     * headers
     */
    protected $headers = array();

    /**
     * sectionOpen
     *
     * Html5 section elements are added around header sections - this marker is used to know
     * if a previous section needs to be closed before a new section can be opened
     *
     */
    protected $sectionOpen = 'header';

    /**
     * transform
     *
     * Ensure if there's an open section it is closed
     *
     * @param mixed $text
     */
    public function transform($text) {
        $return = parent::transform($text);
        if ($this->sectionOpen) {
            $return .= '</section>';
            $this->sectionOpen = false;
        }

        return $return;
    }

    public function getHeaders() {
        return $this->headers;
    }

    /**
     * getSection
     */
    public function getSection() {
        return $this->sectionOpen;
    }

    /**
     * setSection
     *
     * @param string $value
     * @param mixed $force
     */
    public function setSection($value = 'section', $force = false) {
        if ($this->sectionOpen === 'header' || $force) {
            $this->sectionOpen = $value;
        }

        return $this->sectionOpen;
    }

    /**
     * _doHeaders_callback_atx
     *
     * @param mixed $matches
     */
    public function _doHeaders_callback_atx($matches) {
        if (empty($matches[3])) {
            $matches[3] = Inflector::slug($matches[2], '-');
        }
        $link = $this->getAnchorLink($matches[3]);

		$level = strlen($matches[1]);
		$attr  = $this->_doHeaders_attr($id =& $matches[3]);
        $this->headers[] = array(
            'level' => $level,
            'id' => end($this->headerIds),
            'title' => $matches[2]
        );
        $openSection = $this->getSection();
        $section = $this->setSection();
		$block = "<$section><h$level$attr>".$this->runSpanGamut($matches[2])."$link</h$level>";

        if ($openSection) {
            $block = "</$openSection>$block";
        }

		return "\n" . $this->hashBlock($block) . "\n\n";
	}

    /**
     * _doHeaders_callback_setext
     *
     * @param mixed $matches
     */
	public function _doHeaders_callback_setext($matches) {
        if (!$matches[2]) {
            $matches[2] = Inflector::slug($matches[1], '-');
        }
        $link = $this->getAnchorLink($matches[2]);

		if ($matches[3] == '-' && preg_match('{^- }', $matches[1]))
			return $matches[0];
		$level = $matches[3]{0} == '=' ? 1 : 2;
		$attr  = $this->_doHeaders_attr($id =& $matches[2]);
        $this->headers[] = array(
            'level' => $level,
            'id' => end($this->headerIds),
            'title' => $matches[1]
        );
        $openSection = $this->getSection();
        $section = $this->setSection();
		$block = "<$section><h$level$attr>".$this->runSpanGamut($matches[1])."$link</h$level>";

        if ($openSection) {
            $block = "</$openSection>$block";
        }

		return "\n" . $this->hashBlock($block) . "\n\n";
	}

    /**
     * getAnchorLink
     *
     * Generate a unique id, and return a link pointing at it
     *
     * @param mixed $id
     */
    protected function getAnchorLink(&$id) {
        $i = 0;
        $suffix = '';
        while (in_array($id . $suffix, $this->headerIds)) {
            $suffix = '-' . ++$i;
        }
        $id .= $suffix;
        $this->headerIds[] = $id;

        return '<a class="headerAnchor" href="#' . $id . '">§</a>';
    }

    /**
     * initialize
     *
     * Setup predefined properties - such as links and abbrs
     *
     * @param array $config
     */
    public function initialize($config = array()) {
        if (!$config) {
            return;
        }
        foreach($config as $key => $val) {
            $field = 'predef_' . $key;
            $this->$field = $val;
        }
    }

    /**
     * setup
     */
    public function setup() {
        $this->initializeState();
        parent::setup();
    }

    /**
     * teardown
     */
    public function teardown() {
        $this->initializeState();
        parent::teardown();
    }

    /**
     * initializeState
     */
    protected function initializeState() {
        $this->headerIds = array();
        $this->headers = array();
        $this->sectionOpen = 'header';
    }
}
