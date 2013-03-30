<?php
// model/cell.class.php
namespace model;
    
class Cell implements \SplSubject{
/*  **************************************************************    Members */
    private $_ID;
    private $_value;
    private $_observers;
    
/*  ************************************************************    Construct */
    public function __construct($ID, $value){
        $this->_ID          = $ID;
        $this->_value       = $value;
        $this->_observers   = new \SplObjectStorage();
    }
    
/*  **************************************************************    Methods */
    public function render(){
        echo "<td id='cell_{$this->_ID}'>{$this->_value}</td>";
    }
    
    public function __toString(){
        echo "[ID:&lt;{$this->_ID}&gt; Value:&lt;{$this->_value}&gt;]";
    }

/*  ***********************************************************    SplSubject */
    public function attach(\SplObserver $observer){
        $this->_observers->attach($observer);
    }

    public function detach(\SplObserver $observer){
        $this->_observers->detach($observer);
    }

    public function notify(){
        foreach ($this->_observers as $observer) {
            try{
                $observer->update($this);
            }catch(\Exception $e){
                die($e->getMessage());
            }
        }
    }

}   
