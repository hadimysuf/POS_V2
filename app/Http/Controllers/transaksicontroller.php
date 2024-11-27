namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
public function index()
{
$transaksi = Transaksi::with('transaksiDetails.produk')->get();
return view('transaksi.index', compact('transaksi'));
}

public function show($id)
{
$transaksi = Transaksi::with('transaksiDetails.produk')->findOrFail($id);
return view('transaksi.show', compact('transaksi'));
}
}