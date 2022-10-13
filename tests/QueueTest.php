<?php

use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    /*
    //The following 3 commented out methods are the old, long version without making use of consumer/producer methods

    public function testNewQueueIsEmpty()
    {
        $queue = new Queue;
        
        $this->assertEquals(0, $queue->getCount());        
    }
    
    public function testAnItemIsAddedToTheQueue()
    {
        $queue = new Queue;
        
        $queue->push('green');
        
        $this->assertEquals(1, $queue->getCount());                        
    }
    
    public function testAnItemIsRemovedFromTheQueue()
    {
        $queue = new Queue;
        
        $queue->push('green');
        
        $item = $queue->pop();
        
        $this->assertEquals(0, $queue->getCount());
        
        $this->assertEquals('green', $item);                                        
    }
    */
    public function testNewQueueIsEmpty()
    {
        $queue = new Queue;
        
        $this->assertEquals(0, $queue->getCount());
        
        return $queue;        
    }

    /**
     * @depends testNewQueueIsEmpty
     */    
    public function testAnItemIsAddedToTheQueue(Queue $queue)
    {
        $queue->push('green');
        
        $this->assertEquals(1, $queue->getCount());   
        
        return $queue;        
    }
    
    /**
     * @depends testAnItemIsAddedToTheQueue
     */      
    public function testAnItemIsRemovedFromTheQueue(Queue $queue)
    {
        $item = $queue->pop();
        
        $this->assertEquals(0, $queue->getCount());
        
        $this->assertEquals('green', $item);
    }
}