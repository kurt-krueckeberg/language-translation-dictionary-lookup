<?php
declare(strict_types=1);
namespace LanguageTools;

class SystranResultsIterator implements  \SeekableIterator, \ArrayAccess, \Countable {

    private array $matches;
    private int $count;
    private int $current;

    // Callable method that is invoked by current() to return
    // current result.
    private $get_result; 
    private $bpreffx; // If true, also return prefix verb results.
    

    public function __construct(array $matches, bool $prefix_verbs = false)
    {
       $this->matches = $matches;

       // redo...

       $this->cnt = count($matches);

       $this->current = 0; 
    }

    // no-op
    public function offsetSet(mixed $offset, mixed $value) : void
    {
        return; 
    }

    public function offsetExists($offset) : bool
    {
        return isset($this->results[$offset]);
    }

    public function offsetUnset($offset) : void
    {
        return; 
    }

    public function offsetGet($offset) : mixed
    { // redo
        return isset($this->results[$offset]) ? ($this->get_result)( $this->results[$offset] ) : null;
    }
  
    public function count(): int // Countable
    {
        return $this->cnt;
    }

    // SeekableIterator
    public function seek(int $offset) : void 
    {
       if ($offset >= $count || 0 > $offset)
            throw new OutOfBoundsException("offset not in bounds");

       $this->current = $offset;
    } 
    
    /*
     * Examines $match->source
     * 
     * "source": {
            "inflection": "(pl:Frauen)",
            "info": "f",
            "lemma": "Frau",
            "phonetic": "",
            "pos": "noun",
            "term": "Frau"
        }
     * 
     * and returns array with:
     * 'word' => the word as it will b displayed, with plrual, if noun; with conjugation, if verb.
     * 'pos' => the part of speech.
     * 
     */
    
    public function get_source_info(\stdClass $match) : array
    {
        $word = $match->source->lemma;
        
        if ($match->source->pos == 'noun') 
            
            $word .= ' ' . ($match->source->inflection == '') ? "(no plural)" : $match->source->inflection;
                   
        else if ($match->source->pos == 'verb')
            
            $word .= ' ' . $match->source->inflection;
        
        return array('word' => $word, 'pos' => $match->source->pos);
   } 
    /*
     * returns LookupResult
     *  word
     *  pos
     *  defintions, an array of tow elements; 'definition' and 'expressions' 
     */
    public function current(): LookupResult
    {   
        $info = $this->get_source_info($this->matches[$this->current]);
        
        $definitions = array();
        
        foreach($this->matches[$this->current]->targets as $index => $target) { 
         
           $definitions[$index]['definition'] = $target->lemma; 
  
           $definitions[$index]['expressions'] = $target->expressions;
        }
        
        return new LookupResult($info['word'], $info['pos'], $definitions);
    }

    public function key(): mixed
    {
         return $this->current;
    }

    public function next(): void
    {
       ++$this->current;
    }
    
    public function rewind(): void
    {
       $this->current = 0; 
    }

    public function valid(): bool
    {
      return ($this->cnt !== $this->current); 
    }
}
