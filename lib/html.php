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
		}

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