<?

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_ extends Model
{
    use HasFactory;

    protected $table = 'role'; // Nama tabel
    protected $primaryKey = 'id_role'; // Primary key
    public $timestamps = false; // Nonaktifkan timestamps
    // protected $table = 'role';
    // protected $fillable = ['nama'];

    // public function users()
    // {
    // return $this->hasMany(UserPengguna::class, 'role_id');
    // }
}
