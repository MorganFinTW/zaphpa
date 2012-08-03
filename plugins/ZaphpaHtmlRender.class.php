<?php
    require_once 'ZaphpaSingleton.class.php';

    class ZaphpaHtmlRender extends ZaphpaSingleton {
        private $templateVariables = array();
        private $headerTags = array();
        private $cssTags = array();
        private $javascriptTags = array();
        private $pageTpl = '';
        private $contentTpl = '';
        private static $tplRoot = '';

        public static function static_construct() {
            self::$tplRoot = realpath('../../');
        }

        public function get() {
            return $this->templateVariables;
        }

        public function set($varname, $variable) {
            if (!empty($varname)) {
                $this->templateVariables[$varname] = $variable;
            }
        }

        public function getHeadTags() {
            return $this->headerTags;
        }

        public function setHeadMeta($headTagName, $headTagValue) {
            if (!empty($headerName) && !empty($headTagType)) {
                $this->headerTags[] = $this->_formatHeaderTag('head', 'name', $headTagName, 'content', $headTagValue);
            }
        }

        public function setHeadLink($href, $type='', $rel='', $title='') {
            if (!empty($headerName) && !empty($headTagType)) {
                $this->headerTags[] = $this->_formatHeaderTag('head', 'href', $href, 'type', $type,'rel', $rel, 'title', $title);
            }
        }

        public function setTplRoot($path) {
            self::$tplRoot = $path;
        }

        public function setContentTpl($contentTplFileLocation) {
            if (file_exists($this->tplRoot . '/' . $contentTplFileLocation)) {
                $this->contentTpl = $contentTplFileLocation;
            } else {
                throw Exception('Content TPL path does not exist');
            }
        }

        public function setPageTpl($pageTplFileLocation) {
            if (file_exists($this->tplRoot . '/' . $pageTplFileLocation)) {
                $this->pageTpl = $pageTplFileLocation;
            } else {
                throw Exception('Page TPL path does not exist');
            }
        }

        public function getContentTpl() {
            return self::$tplRoot . '/' . $this->contentTpl;
        }

        public function getPageTpl() {
            return self::$tplRoot . '/' . $this->pageTpl;
        }

        private function _formatHeaderTag($tagName) {
            $numArgs = func_num_args();
            $arguments = func_get_args();

            if ($numArgs % 2 != 0) {
                $arguments[] = '';
            }

            $tag = "<$tagName";

            for ($i=1; $i < $numArgs; $i+2) {
                $tag .= ' ' . $arguments[$i] . '="' . $arguments[$i+1] . '"';
            }

            $tag = '>';

            return $tag;
        }


    }ZaphpaHtmlRender::static_construct();
