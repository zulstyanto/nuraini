// YourController.php

namespace App\Http\Controllers;

use App\Models\YourModel; // Gantilah YourModel dengan model yang sesuai
use Illuminate\Http\Request;

class YourController extends Controller
{
    public function destroy($id)
    {
        $yourResource = YourController::find($id);

        if ($yourResource) {
            $yourResource->delete();

            return redirect()->route('your-resource.index')->with('success', 'Data berhasil dihapus');
        }

        return redirect()->route('your-resource.index')->with('error', 'Data tidak ditemukan');
    }
}
