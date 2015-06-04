<?php

namespace de {

	abstract class HTMLEntity {

		/**
		 * rendering children should be as simple as
		 * as calling create() on all children
		 */
		protected $children = [];

		/**
		 * render self as html source code
		 */
		abstract public function render();

		/**
		 * add child element
		 */
		public function add_child($entity) {
			array_push($this->children, $entity);
			return $this;
		}

	}

	class HTMLElement extends HTMLEntity {

		public $attributes = [];
		public $val = null;
		public $name = null;
		public $closed = false;

		public function __construct($name) {
			$this->name = $name;
			return $this;
		}

		public function attr($attrs) {
			if (is_string($attrs)) {
				/**
				 * get prop
				 */
				return $this->attributes[$attrs];
			}
			/**
			 * set props
			 */
			foreach ($attrs as $k => $v) {
				$this->attributes[$k] = $v;
			}
			return $this;
		}

		public function val($val) {
			$this->val = $val;
			return $this;
		}

		public function toggle_closed() {
			$this->closed = !$this->closed;
		}

		public function render() {
			$res = '<' . $this->name;

			foreach ($this->attributes as $k => $v) {
				if (!$v) {
					$res .= ' ' . $k;
				}
				else {
					$res .= ' ' . $k . '="' . $v . '"';
				}
			}

			$res .= '>';

			foreach ($this->children as $child) {
				$res .= $child->render();
			}

			if ($this->val) $res .= $this->val;

			if (!$this->closed) $res .= '</' . $this->name . '>';

			return $res;
		}

		public function write() {
			echo $this->render();
			return $this;
		}
		
	}

	function html($name) {
		return new HTMLElement($name);
	}

}

?>