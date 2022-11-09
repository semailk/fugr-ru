<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $full_name
 * @property string $company
 * @property string $phone
 * @property string $email
 * @property string $date_of_birth
 * @property string $photo
 *
 * Class Notebook
 * @package App\Models
 */
class Notebook extends Model
{
    use HasFactory;

    const NOTEBOOK_FULL_NAME = 'full_name';
    const NOTEBOOK_ID = 'id';
    const NOTEBOOK_COMPANY = 'company';
    const NOTEBOOK_PHONE = 'phone';
    const NOTEBOOK_EMAIL = 'email';
    const NOTEBOOK_PHOTO = 'photo';
    const NOTEBOOK_DATE_OF_BIRTH = 'date_of_birth';

    public $timestamps = false;
    
    protected $fillable = [
      self::NOTEBOOK_COMPANY,
      self::NOTEBOOK_DATE_OF_BIRTH,
      self::NOTEBOOK_EMAIL,
      self::NOTEBOOK_PHONE,
      self::NOTEBOOK_FULL_NAME,
      self::NOTEBOOK_PHOTO,
    ];
}
