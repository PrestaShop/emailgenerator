<?php

require dirname(__FILE__).'/SimpleParserBase.php';

class SimplePHPFunctionCallParser extends SimpleParserBase
{
	private $function_name;
	private $pattern;
	private $matches;
	private $arguments;

	public function __construct($function_name)
	{
		$this->function_name = $function_name;
		$this->pattern = '/\b'.$this->function_name.'\s*\(\s*/';
	}

	public function doParse()
	{
		$this->matches = array();
		while (($match = $this->getMatch()) !== false)
			$this->matches[] = $match;
		return $this->matches;
	}

	public function reset()
	{
		parent::reset();
		$this->arguments = array();
	}

	public function storeArgument()
	{
		$this->arguments[] = trim($this->buffer);
		$this->buffer = '';
	}

	public function getMatch()
	{
		$this->reset();

		if ($this->skipUntilAfter($this->pattern) !== false)
		{
			$this->push('start');
			while (($c = $this->peek()) !== '')
			{
				$advance = true;
				$store = true;

				if ($this->in('start'))
				{
					// Got final parenthesis, return arguments
					if ($c === ')')
					{
						$this->storeArgument();
						$this->at++;
						return $this->arguments;
					}
					else
					{
						$this->push('argument');
						$advance = false;
					}
				}
				else if ($this->in('argument'))
				{
					if ($c === ')')
					{
						$this->storeArgument();
						$this->at++;
						return $this->arguments;
					}
					else if ($c === '(')
						$this->push('paren');
					else if ($c === '"' || $c === "'")
					{
						$this->quote = $c;
						$this->push('string');
					}
					else if ($c === ',')
					{
						$this->storeArgument();
						$store = false;
					}
				}
				else if ($this->in('string'))
				{
					if ($c === $this->quote)
						$this->pop();
					else if ($c === '\\')
						$this->push('escape');
				}
				else if ($this->in('escape'))
				{
					$this->pop();
				}
				else if ($this->in('paren'))
				{
					if ($c === '(')
						$this->push('paren');
					else if ($c === ')')
						$this->pop();
				}

				if ($advance)
				{
					if ($store)
					{
						$this->buffer .= $c;
					}
					$this->at++;
				}
			}
		}
		else
			return false;
	}
}