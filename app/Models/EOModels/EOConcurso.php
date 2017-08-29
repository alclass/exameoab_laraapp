<?php
namespace App\Models\EOModels;
// use App\Models\EOModels\EOConcurso;

use Illuminate\Database\Eloquent\Model;

class EOConcurso extends Model {

  protected $table = 'eoconcursos';
  protected $date  = ['exame_date'];

  $fillable  = [
    'ano', 'seq_ano', 'banca', 'seq_banca', 'exame_date',
    'n_inscritos', 'n_aprovados', 'graudificuldade',
    'comentario_editor',
  ];

} // ends class EOConcurso extends Model
