<?php

namespace App\Helpers\Snippets;

/**
 * Trait Snippets
 * @package App\Helpers\Snippets
 *
 * @params string $message
 *
 */

trait Snippets
{
    protected static $patternSnippet = "/\*\w+\*/";

    private $snippets = [
        'help_commands',
    ];

    protected function getSnippets()
    {
        return $this->snippets;
    }



    protected function toArraySnippetsWithMessage()
    {
        if (!empty($this->message)) {
            preg_match_all(self::$patternSnippet, $this->message, $matches);
        }

        return !empty($matches[0]) ? $matches[0] : [];
    }
    protected function toStringSnippetsWithMessage()
    {
        $snippets = $this->toArraySnippetsWithMessage();

        return implode(',', $snippets);
    }
    protected function replaceSnippet($snippet, $str)
    {
        if(!empty($this->message)){
            $this->message = str_replace("*{$snippet}*", $str, $this->message);
        }
    }
    protected function clearSnippetsInMessage()
    {
        if(!empty($this->message)){
            $this->message = preg_replace(self::$patternSnippet, '', $this->message);
        }
    }
    private function executeSnippet($snippet)
    {
        $method = camel_case($snippet);
        if(method_exists($this, $method))
            $this->$method($snippet);
        else
            $this->replaceSnippet("*{$snippet}*", '');
    }
    private function executeSnippets(array $snippets){
        foreach ($this->toArraySnippetsWithMessage() as $snippet){
            $snippet = str_replace('*', '', $snippet);
            if(in_array($snippet, $snippets))
                $this->executeSnippet($snippet);
        }
        $this->clearSnippetsInMessage();
    }

    /*
     * METHODS
     */
    protected function helpCommands($snippet)
    {
        $list = PHP_EOL;

        foreach($this->vkBot->commands()->isEnable()->where('description', '<>', '')->get() as $command){
            /** @var \App\Models\Command $command */
            $list .= "{$command->command}: {$command->description}".PHP_EOL;
        }

        $this->replaceSnippet($snippet, $list);
    }

}