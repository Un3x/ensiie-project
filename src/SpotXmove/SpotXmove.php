<?php
namespace SpotXmove;

class SpotXmove
{
	/**
	 * @var int
	 */
	private $idSpot;

	/**
	 * @var int
	 */
	private $idMove;

	/**
	 * @return int
	 */
	public function getIdSpot() {
		return $this->idSpot;
	}

	/**
	 * @return int
	 */
	public function getIdMove() {
		return $this->idMove;
	}

	/* pas de setters car la table est mise à jour ON UPDATE CASCADE */

}