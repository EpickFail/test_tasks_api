<?php
namespace App;

class TaskFilter
{
    /**
     * builder of task
     * 
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;
    
    /**
     * Instanse of Request
     * 
     * @var \Illuminate\Http\Request 
     */
    protected $request;
    
    /**
     * offset for list request
     * 
     * @var int 
     */
    protected $offset = 0;
    
    /**
     * limit for list request
     *
     * @var int 
     */
    protected $limit = 10;
    
    /**
     * count of element in storage
     * 
     * @var int
     */
    protected $count;
    
    /**
     * Create a nef TaskController instance.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Http\Request $request
     */
    public function __construct($builder, $request) 
    {
        $this->builder = $builder;    
        $this->request = $request;
    }
    
    /**
     * Apply request filters
     * 
     * @return array
     */
    public function apply():array
    {
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        $this->count = $this->builder->count();
        return $this->wrapResult($this->builder->skip($this->offset)->take($this->limit)->get());
    }
    
    /**
     * Wrap the result of the request with additional information.
     * 
     * @param object $result
     * @return array
     */
    private function wrapResult(object $result):array
    {
        $wrapper_result = array_merge(
                ['data' => $result],
                ['total' => $this->count],
                ['limit' => $this->limit],
                ['offset' => $this->offset],
                ['next' => $this->offset+$this->limit]
            );
        return $wrapper_result;
    }
    
    /**
     * Show filters in request.
     * 
     * @return array
     */
    public function filters():array
    {
        return $this->request->all();
    }
    
    /**
     * Filter on status of task 
     * 
     * @param boolean $value
     */
    private function status(bool $value)
    {
        return $this->builder->where('status', $value);
    }
    
    /**
     * Filter on title of task 
     * 
     * @param string $value
     */
    private function title(int $value)
    {
        return $this->builder->where('title', $value);
    }
    
    /**
     * Filter on responsible_id of task 
     * 
     * @param int $value
     */
    private function responsible_id(int $value)
    {
        return $this->builder->where('responsible_id', $value);
    }
    
    /**
     * Filter on created_by of task 
     * 
     * @param int $value
     */
    private function created_by(int $value)
    {
        return $this->builder->where('created_by', $value);
    }
    
    /**
     * Filter on deadline of task 
     * 
     * @param dateTime $value
     */
    private function deadline(int $value)
    {
        return $this->builder->where('deadline', $value);
    }
    
    /**
     * Set offset for sampling
     * 
     * @param int $value
     * @return int
     */
    private function offset(int $value):int
    {
        return $this->offset = $value;
    }
    
    /**
     * Set limit for sampling
     * 
     * @param int $value
     * @return int
     */
    private function limit(int $value):int
    {
        return $this->limit = $value;
    }

}
