<?php

namespace App\Http\Controllers;

use App\Models\Loading;
use App\Models\Packing;
use App\Models\Planing;
use App\Models\Report;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller

{
    // Admin
    public function dashboardAdmin() {
        function data_user() {
            $startDate = now()->subMonths(10)->startOfMonth();
            $endDate = now()->endOfMonth();

            $results = User::select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                ->orderBy(DB::raw('YEAR(created_at)'))
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get()
                ->mapWithKeys(function ($item) {
                    $monthYear = $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
                    return [$monthYear => $item->count];
                })
                ->toArray();

            $monthlyCounts = [];
            $currentDate = now()->startOfMonth();

            for ($i = 0; $i < 10; $i++) {
                $monthYear = $currentDate->format('Y-m');
                $monthlyCounts[] = $results[$monthYear] ?? 0;
                $currentDate->subMonth();
            }
            return $monthlyCounts;
        }

        function daily_report() {
            $currentYear = now()->year;
            $results = Report::select(DB::raw('MONTH(created_at) as month, COUNT(*) as count'))
                ->whereYear('created_at', $currentYear)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->month => $item->count];
                })->toArray();

            $data = [];
            for ($month = 1; $month <= 12; $month++) {
                $data[] = $results[$month] ?? 0;
            }
            return $data;
        }

        return view('admin.dashboard' , [
            'data_user'     => json_encode(data_user()),
            'daily_report'  => json_encode(daily_report()),
        ]);
    }

    public function dashboardProfile() {
        return view('admin.profile', ['faker' => Faker::create()]);
    }

    public function dashboardProfilePut(Request $request, $id) {
        $this->validate($request, [
            'nama'          => 'required|max:255',
            'id_card'       => 'required|max:20',
            'foto_profile'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password_lama' => 'nullable|min:8',
            'password'      => 'nullable|min:8',
            'repassword'    => 'nullable|same:password',
        ]);
        $data = $request->except('password_lama','__token','repassword');

        if ($request->filled('password_lama')) {
            if (!Hash::check($request->password_lama, Auth::user()->password)) {
                return redirect()->back()->withErrors('Password lama tidak sesuai.');
            }
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profile')) {
            $existingData = User::find(Auth::user()->id);
            if ($existingData && $existingData->foto_profile) {
                $previousFilePath = public_path('assets/img/profile/') . $existingData->foto_profile;
                if (file_exists($previousFilePath)) {
                    // unlink($previousFilePath);
                }
            }

            $file = $request->file('foto_profile');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/profile/'), $fileName);
            $data['foto_profile'] = $fileName;
        }

        if (User::find($id)->update($data)) {
            Alert::success('Berhasil','Data Berhasil Diupdate!');
            return redirect()->back();
        }
    }

    public function dashboardUser() {
        confirmDelete('Hapus Data', 'Apakah Anda Yakin Menghapus Data ?');
        return view('admin.user', ['data' => User::show_all()]);
    }

    public function dashboardUserTambah(Request $request) {
        $this->validate($request, [
            'nama'      => 'required',
            'id_card'   => 'required',
            'role'      => 'required',
        ]);

        $data               = $request->all();
        $data['password']   = Hash::make('katsuyama2024');
        if (User::create($data)) {
            Alert::success('Berhasil','Data Berhasil Ditambah!');
            return redirect()->back();
        }
    }

    public function dashboardUserEdit(Request $request, $id) {
        $this->validate($request, [
            'nama'      => 'required',
            'id_card'   => 'required',
            'role'      => 'required',
            'password'  => 'nullable'
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }else {
            unset($data['password']);
        }

        if (User::find($id)->update($data)) {
            Alert::success('Berhasil','Data Berhasil Diupdate!');
            return redirect()->back();
        }
    }

    public function dashboardUserHapus($id) {
        if (User::find($id)->delete()) {
            Alert::success('Berhasil','Data Berhasil Dihapus!');
            return redirect()->back();
        }
    }

    // Loading
    public function dashboardLoading() {
        function pie() {
            $data = [];
            $data[] = Planing::all()->count();
            $data[] = Loading::where('user_id', Auth::user()->id)->count();
            return $data;
        }

        function report() {
            $currentYear = now()->year;
            $results = Report::select(DB::raw('MONTH(created_at) as month, COUNT(*) as count'))
                ->whereYear('created_at', $currentYear)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->month => $item->count];
                })->toArray();

            $data = [];
            for ($month = 1; $month <= 12; $month++) {
                $data[] = $results[$month] ?? 0;
            }
            return $data;
        }
        return view('loading.dashboard' , [
            'pie'       => json_encode(pie()),
            'report'    => json_encode(report())
        ]);
    }

    public function ProfileLoading() {
        return view('loading.profile');
    }

    // packing
    public function dashboardPacking() {
        function pie_packing() {
            $data = [];
            $data[] = Planing::all()->count();
            $data[] = Loading::all()->count();
            $data[] = Packing::where('user_id', Auth::user()->id)->count();
            return $data;
        }
        function report_packing() {
            $currentYear = now()->year;
            $results = Report::select(DB::raw('MONTH(created_at) as month, COUNT(*) as count'))
                ->whereYear('created_at', $currentYear)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->month => $item->count];
                })->toArray();

            $data = [];
            for ($month = 1; $month <= 12; $month++) {
                $data[] = $results[$month] ?? 0;
            }
            return $data;
        }

        return view('packing.dashboard', [
            'pie'       => json_encode(pie_packing()),
            'report'    => json_encode(report_packing())
        ]);
    }

    public function ProfilePacking() {
        return view('packing.profile');
    }

}
