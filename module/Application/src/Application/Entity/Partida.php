<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Application\Entity\Repository\PartidaRepository")
 * @ORM\Table(name="partida")
 */

class Partida {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	private $id_partida;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $data_inicio;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $data_fim;

	/**
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Campeonato", inversedBy="partida")
	 * @ORM\JoinColumn(name="id_campeonato",referencedColumnName="id_campeonato", nullable=false)
	 */
	private $campeonato;

	public function getIdPartida() {
		return $this->id_partida;
	}

	public function getDataInicio() {
		return $this->data_inicio;
	}

	public function getDataFim() {
		return $this->data_fim;
	}

	public function setIdPartida($id_partida) {
		$this->id_partida = $id_partida;
		return $this;
	}

	public function setDataInicio($data_inicio) {
		$this->data_inicio = $data_inicio;
		return $this;
	}

	public function setDataFim($data_fim) {
		$this->data_fim = $data_fim;
		return $this;
	}

	public function getCampeonato() {
		return $this->campeonato;
	}

	public function setCampeonato($campeonato) {
		$this->campeonato = $campeonato;
		return $this;
	}

}
