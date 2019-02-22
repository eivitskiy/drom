<?php

/**
 * @Entity @Table(name="todos")
 **/
class Todos
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="integer", nullable=false) **/
    protected $user_id;

    /** @Column(type="string", nullable=false) **/
    protected $task;

    /** @Column(type="boolean", nullable=false) **/
    protected $done;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @param mixed $task
     */
    public function setTask($task): void
    {
        $this->task = $task;
    }

    /**
     * @return mixed
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * @param mixed $done
     */
    public function setDone($done): void
    {
        $this->done = $done;
    }


}