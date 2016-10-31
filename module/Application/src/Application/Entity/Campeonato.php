<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Application\Entity\Repository\CampeonatoRepository")
 * @ORM\Table(name="campeonato")
 */

class Campeonato {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	private $id_campeonato;

	/**
	 * @ORM\Column(type="string", length=45)
	 */
	private $titulo;

	/**
	 * @ORM\Column(type="text")
	 */
	private $descricao;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $data_inicio;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $data_fim;

	/**
	 * @ORM\Column(type="decimal")
	 */
	private $valor_partida;

	/**
	 * @ORM\Column(type="decimal")
	 */
	private $porcentagem_campeonato;

	/**
	 * @ORM\OneToMany(targetEntity="Application\Entity\Partida", mappedBy="campeonato")
	 */
	private $partida;

	/**
	 * @ORM\OneToMany(targetEntity="Application\Entity\CampeonatoPontuacao", mappedBy="campeonato")
	 */
	private $campeonato_pontuacao;

	/**
	 * @ORM\OneToMany(targetEntity="Application\Entity\CampeonatoUsuario", mappedBy="campeonato")
	 */
	private $campeonato_usuario;

	public function setIdCampeonato($id_campeonato) {
		$this->id_campeonato = $id_campeonato;
		return $this;
	}

	public function getIdCampeonato() {
		return $this->id_campeonato;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
		return $this;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function setDataInicio($data_inicio) {
		$dataInicio        = \DateTime::createFromFormat('j/m/Y', $data_inicio);
		$this->data_inicio = new \DateTime(date('Y-m-d H:i:s', strtotime($dataInicio->format('Y-m-d'))));
		return $this;
	}

	public function getDataInicio() {
		return $this->data_inicio->format('d/m/Y');
	}

	public function setDataFim($data_fim) {
		$dataFim        = \DateTime::createFromFormat('j/m/Y', $data_fim);
		$this->data_fim = new \DateTime(date('Y-m-d H:i:s', strtotime($dataFim->format('Y-m-d'))));
		return $this;
	}

	public function getDataFim() {
		return $this->data_fim->format('d/m/Y');
	}

	public function setValorPartida($valor_partida) {
		$this->valor_partida = $valor_partida;
		return $this;
	}

	public function getValorPartida() {
		return $this->valor_partida;
	}

	public function setPorcentagemCampeonato($porcentagem_campeonato) {
		$this->porcentagem_campeonato = $porcentagem_campeonato;
		return $this;
	}

	public function getPorcentagemCampeonato() {
		return $this->porcentagem_campeonato;
	}

	public function getArrayCopy() {
		return [
			'id_campeonato'          => $this->id_campeonato,
			'titulo'                 => $this->titulo,
			'descricao'              => $this->descricao,
			'valor_partida'          => $this->valor_partida,
			'porcentagem_campeonato' => $this->porcentagem_campeonato,
			'data_inicio'            => $this->getDataInicio(),
			'data_fim'               => $this->getDataFim(),
		];
	}

}
