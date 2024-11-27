namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
use HasFactory;

protected $table = 'transaksi_detail';
protected $fillable = ['id_transaksi', 'id_produk', 'harga', 'jumlah', 'total'];

public function transaksi()
{
return $this->belongsTo(Transaksi::class, 'id_transaksi');
}

public function produk()
{
return $this->belongsTo(Product::class, 'id_produk');
}
}