<?php

/**
 * @Entity @Table(name="todos")
 **/
class Todo
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string", nullable=false) **/
    protected $task;

    /** @Column(type="boolean", nullable=false) **/
    protected $done;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @ManyToOne(targetEntity="User", inversedBy="todos")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }
}