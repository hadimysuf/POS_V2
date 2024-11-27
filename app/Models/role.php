namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
use HasFactory;

protected $table = 'role';
protected $fillable = ['nama'];

public function users()
{
return $this->hasMany(UserPengguna::class, 'role_id');
}
}