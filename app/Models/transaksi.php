namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
use HasFactory;

protected $table = 'transaksi';
protected $fillable = ['tanggal_waktu', 'nomor_transaksi', 'total', 'nama_user', 'bayar', 'kembali', 'no_customer'];

public function transaksiDetails()
{
return $this->hasMany(TransaksiDetail::class, 'id_transaksi');
}
}