<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionBank;
use Illuminate\Http\Request;

class TransactionBankAdminController extends Controller
{
    public function index()
    {
        $banks = TransactionBank::paginate(50);

        return view('admin.transactionBanks.list', compact('banks'));
    }

    public function create()
    {
        return view('admin.transactionBanks.create');
    }

    public function edit($id)
    {
        $bank = TransactionBank::find($id);
        return view('admin.transactionBanks.edit', compact('bank'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->only([
                'name',
                'activated',
                'description'
            ]);

            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName(); // Gera um nome único
                $request->file('image')->move(public_path('admin/banks'), $imageName);

                // Salva o caminho no banco de dados
                $data['logo'] = 'admin/banks/' . $imageName;
            }
            $bank = TransactionBank::create($data);

            flash(__('admin_alert.pkgcreate'))->success();

            // dd($bank);
            return redirect()->route('admin.banks.index');
        } catch (Exception $e) {
            // dd($e);
            flash(__('admin_alert.pkgnotcreate'))->error();
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            $package = TransactionBank::find($id);
            $package->activated = false;

            $package->update();

            flash(__('admin_alert.pkgremove'))->success();
            return redirect()->route('admin.banks.index');
        } catch (Exception $e) {

            flash(__('admin_alert.pkgnotremove'))->error();
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $data = $request->only([
                'name',
                'activated',
                'description'
            ]);

            $package = TransactionBank::find($id);


            if ($request->hasFile('image')) {
                // Exclui a imagem antiga, se existir
                if ($package->logo && file_exists(public_path($package->logo))) {
                    unlink(public_path($package->logo));
                }

                // Gera um novo nome e move o arquivo
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('admin/banks'), $imageName);

                // Salva o caminho da nova imagem no banco de dados
                $data['logo'] = 'admin/banks/' . $imageName;
            }

            $package->update($data);

            flash(__('admin_alert.pkgupdate'))->success();
            return redirect()->route('admin.banks.index');
        } catch (Exception $e) {

            flash(__('admin_alert.pkgnotupdate'))->error();
            return redirect()->back();
        }
    }
}
