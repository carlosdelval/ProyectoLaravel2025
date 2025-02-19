<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialVista;
use Illuminate\Support\Facades\Storage;


class HistorialVistaController extends Controller
{
    public function uploadPdf(Request $request, $id)
    {
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:2048',
        ]);

        $historial = HistorialVista::findOrFail($id);

        if ($request->file('pdf')) {
            $path = $request->file('pdf')->store('historial_pdfs', 'public');
            $historial->pdf_path = $path;
            $historial->save();
        }

        return redirect()->back()->with('success', 'PDF subido correctamente');
    }

    // Controlador para la descarga del PDF
    public function descargarPDF($id)
    {
        $historial = HistorialVista::findOrFail($id);
        if ($historial->documentacion) {
            return response()->download(storage_path('app/public/' . $historial->documentacion));
        }
        return redirect()->back()->with('error', 'No se encontró el archivo.');
    }

    // Controlador para editar historial_vista
    public function edit($id){
        $historial = HistorialVista::findOrFail($id);
        return view('admin.historial.edit', compact('historial'));
    }
}
