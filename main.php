<?php

/**
* Пользователь
* Может редактировать только свои сообщения
* Удалять сообщения не может
* Class User
*/
class User
{
	/** @var int */
	private $id;
	
	/** @var string */
	private $name;
	
	function __construct(int $id, string $name)
	{
		$this -> id = $id;
		$this -> name = $name;
	}
	
	/**
	* Проверяет, может ли пользователь редактировать сообщение
	* @param Message $message
	* @return bool
	*/
	public function canEdit(Message $message): bool
	{
		if ($message->getCreator()->getID() == $this->id):
			return true;
		else:
			return false;
		endif;
	}

	/**
	* Проверяет, может ли пользователь удалить сообщение
	* @param Message $message
	* @return bool
	*/
	public function canDelete(Message $message): bool
	{
		return false;
	}
	
	/**
	* Возвращает id пользователя
	* @return int
	*/
	public function getID(): int
	{
		return $this -> id;
	}
	
	/**
	* Создаёт новое сообщение от лица пользователя
	* @param Message $text
	* @return Message
	*/
	public function newMessage(string $text)
	{
		return new Message($this, $text);
	}
}

/**
* Менеджер
* Может редактировать свои сообщения и собщения других пользователей
* Удалять сообщения не может
* Class Manager
*/
class Manager extends User
{
	public function canEdit(Message $message): bool
	{
		return true;
	}
}

/**
* Администратор
* Может редактировать и удалять любые сообщения
* Class Admin
*/
class Admin extends User
{
	public function canEdit(Message $message): bool
	{
		return true;
	}

	public function canDelete(Message $message): bool
	{
		return true;
	}
}

class Message
{
	/** @var User */
	private $creator;
    
	/** @var string */
 	private $text;
    
	public function __construct(User $creator, string $text)
	{
		$this -> creator = $creator;
		$this -> text = $text;
	}
    
	public function getCreator(): User
	{
		return $this -> creator;
	}
}
