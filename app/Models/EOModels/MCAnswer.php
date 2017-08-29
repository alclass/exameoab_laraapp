<?php
namespace App\Models\EOModels;
// use App\Models\EOModels\MCAnswer;

use Illuminate\Database\Eloquent\Model;

class MCAnswer extends Model {

    private   $letters = ['A','B','C','D','E'];
    protected $table = 'mcanswers';
    protected $fillable  = [
      'position', // maps to LETTER (A B C D E)
      'texto_escolha',
      'true_or_false_if_application',
      'comentario_editor',
    ];

    public function get_letter() {
      if ($this->position < count($letters)) {
        return $letters[$this->position];
      }
      return 'X';
    }

    public function mcquestion() {
      return $this->belongsTo('App\Models\EOModels\MCQuestion', 'mcquestion_id');
    }

    public function knowledgeareas() {
      return $this->hasMany('App\Models\AcadModels\KnowledgeArea', 'mcquestion_id');
    }

} // ends class MCAnswer extends Model
