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
		
	}

	function html($name) {
		return new HTMLElement($name);
	}

	class Form extends HTMLEntity {

		public $action = "";
		public $method = null;

		public function __construct($method) {
			$this->method = $method;
		}

		public function render() {
			$res = '<form action="' . $this->action .
				'" method="' . $this->method . '"';
			$res .= '>';

			foreach ($this->children as $child) {
				$res .= $child->render();
			}

			return $res . '</form>';
		}

	}

	class Button extends HTMLEntity {

		public $name = null;
		public $text = null;
		public $value = null;

		public function __construct($text) {
			$this->text = $text;
		}

		public function render() {
			$res = '<button';
			if ($this->name) $res .= ' name="' . $this->name . '"';
			if ($this->value) $res .= ' value="' . $this->value . '"';

			return $res . '>' . $this->text . '</button>';
		}

	}

}

?>