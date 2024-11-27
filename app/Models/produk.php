namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
use HasFactory;

protected $table = 'produk';
protected $fillable = ['nama_produk', 'harga', 'jumlah'];

public function transaksiDetails()
{
return $this->hasMany(TransaksiDetail::class, 'id_produk');
}
}