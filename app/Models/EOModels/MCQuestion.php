<?php
namespace App\Models\EOModels;
// use App\Models\EOModels\MCAnswer;

use Illuminate\Database\Eloquent\Model;

class MCQuestion extends Model {

  protected $table = 'mcquestions';
  protected $fillable  = [
    // 'eoconcurso_id'
    'level1_knowledgearea_id',    'uf',    'seq_banca',    'graudificuldade',
    'is_assunto_conceitual',    'is_assunto_lei_seca',    'is_assunto_jurisprudencial',
    'is_assunto_interpretativo',    'is_pacificado_if_jurisprudencial',
    'enunciado',    'comentario_editor',    'resposta_letra',
  ];

  public function eoconcurso() {
    return $this->belongsTo('App\Models\EOModels\EOConcurso', 'eoconcurso_id');
  }

  public function knowledgeareas() {
    return $this->hasMany('App\Models\AcadModels\KnowledgeArea', 'knowledgearea_id')
  }

} // ends class MCQuestion extends Model
