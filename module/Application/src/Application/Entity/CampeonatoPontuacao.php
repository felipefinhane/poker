<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Application\Entity\Repository\CampeonatoPontuacaoRepository")
 * @ORM\Table(name="campeonato_pontuacao")
 */
class CampeonatoPontuacao {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id_campeonato_pontuacao;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Campeonato", inversedBy="campeonato_pontuacao")
     * @ORM\JoinColumn(name="id_campeonato",referencedColumnName="id_campeonato", nullable=false)
     */
    private $campeonato;

    /**
     * @ORM\Column(type="integer")
     */
    private $posicao;

    /**
     * @ORM\Column(type="decimal")
     */
    private $valor_pontuacao;

    public function getIdCampeonatoPontuacao() {
        return $this->id_campeonato_pontuacao;
    }

    public function getCampeonato() {
        return $this->campeonato;
    }

    public function getPosicao() {
        return $this->posicao;
    }

    public function getValorPontuacao() {
        return $this->valor_pontuacao;
    }

    public function setIdCampeonatoPontuacao($id_campeonato_pontuacao) {
        $this->id_campeonato_pontuacao = $id_campeonato_pontuacao;
        return $this;
    }

    public function setCampeonato($campeonato) {
        $this->campeonato = $campeonato;
        return $this;
    }

    public function setPosicao($posicao) {
        $this->posicao = $posicao;
        return $this;
    }

    public function setValorPontuacao($valor_pontuacao) {
        $this->valor_pontuacao = $valor_pontuacao;
        return $this;
    }

    public function getArrayCopy(){
        return [
            'id_campeonato_pontuacao' => $this->id_campeonato_pontuacao,
            'campeonato' => $this->campeonato,
            'posicao' => $this->posicao,
            'valor_pontuacao' => $this->valor_pontuacao,
        ];
    }

}
