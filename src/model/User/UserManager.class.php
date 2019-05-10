<?php

require_once('raceManager.class.php');
require_once('User.class.php');

/**
 * La classe gérant User
 */
abstract class UserManager 
{

	/**
	 * connection à la BD
	 * @var \PDO
	 * @access protected
	 */
	protected  $connection;


	/**
	 * constructeur
	 * @access public
	 * @param \PDO $connection la connection à la BD
	 */
	public  function __construct(\PDO $connection) 
	{
		$this->connection=$connection;
	}


	/**
	 * ajoute user dans la BD
	 * @access public
	 * @param User $user l'utilisateur à ajouter à la BD
	 * @return void
	 */
	public abstract  function add(User $user) ;

	/**
	 * suprime user dans la BD
	 * @access public
	 * @param User $user l'utilisateur à suprimer
	 * @return void
	 */
	public abstract  function delete(User $user) ;

	/**
	 * renvoie l'utilisateur correspondant à l'id ou null s'il n'y en à pas qui correspond
	 * @access public
	 * @param int $id L'id de l'utilisateur à aller chercher
	 * @return User
	 */
	public abstract  function get($id) ;

	/**
	 * renvoie la liste de tout les utilisateurs
	 * @access public
	 * @return void
	 */
	public abstract  function getList() ;

	/**
	 * modifie la BD avec les nouvelles valeurs de user
	 * @access public
	 * @param User $user nouvelles valeur à mettre dans la BD
	 * @return void
	 */
	public abstract  function update(User $user) ;

	/**
	 * change la valeur de connection
	 * @access public
	 * @param /PDO $connection nouvelle connection
	 * @return void
	 */
	public final  function setDb(\PDO $connection) 
	{
		$this->connection=$connection;
	}

}
