<?php

abstract class SimpleParserBase
{
	protected $string;
	protected $states;
	protected $buffer;
	protected $at;

	abstract public function doParse();

	protected function push($state)
	{
		$this->states[] = $state;
		return $state;
	}

	protected function pop()
	{
		if (count($this->states) === 0)
			return false;

		return array_pop($this->states);
	}

	protected function state()
	{
		if (count($this->states) === 0)
			return false;
		return $this->states[count($this->states)-1];
	}

	protected function in($state)
	{
		return $this->state() === $state;
	}

	protected function skipUntilAfter($regexp)
	{
		$m = array();
		$found = preg_match($regexp, $this->string, $m, PREG_OFFSET_CAPTURE, $this->at);
		if ($found)
		{
			$this->at = $m[0][1] + mb_strlen($m[0][0]);
			return $m[0][0];
		}
		return false;
	}

	protected function peek($n=1)
	{
		return mb_substr($this->string, $this->at, $n);
	}

	protected function get($n=1, $store=true)
	{
		$str = $this->peek($n);
		$this->at += mb_strlen($str);
		if ($store)
			$this->buffer .= $str;
		return $str;
	}	

	public function reset()
	{
		$this->states = array();
		$this->buffer = '';
	}

	public function parse($string)
	{
		$this->string = $string;
		$this->at = 0;

		return $this->doParse();
	}
}