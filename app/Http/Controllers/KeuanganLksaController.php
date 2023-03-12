<?php

namespace App\Http\Controllers;

use App\Models\LksaFinance;
use Illuminate\Http\Request;

class KeuanganLksaController extends Controller
{
    public function pemasukan()
    {
        $data = [
            'active' => 'income-lksa'
        ];

        return view('income-lksa', $data);
    }

    public function dataPemasukan()
    {
        $data = [
            'active' => 'data-income-lksa'
        ];

        return view('data-income-lksa', $data);
    }

    public function exportDataPemasukan()
    {
        $data = [
            'incomes' => LksaFinance::where('transaksi', 'pemasukan')->get()
        ];

        return view('export.export-pemasukan-lksa-pdf', $data);
    }

    public function pengeluaran()
    {
        $data = [
            'active' => 'outcome-lksa'
        ];

        return view('outcome-lksa', $data);
    }

    public function dataPengeluaran()
    {
        $data = [
            'active' => 'data-outcome-lksa'
        ];

        return view('data-outcome-lksa', $data);
    }

    public function laporan()
    {
        $data = [
            'active' => 'income-and-expense-report'
        ];

        return view('income-and-expense-report', $data);
    }
}
