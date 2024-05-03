<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class LotteryController extends Controller
{
    private $top = [];
    private $neighbor = [];
    private $second = [];
    private $lastTwoDigit = [];
    private $out = [];

    public function index()
    {
        return view('lottery.index');
    }

    public function draw()
    {

        $top = $this->random(1000, 3);
        $this->top[] = $top;
        $this->neighbor[] = $this->pad($top + 1, 3);
        $this->neighbor[] = $this->pad($top - 1, 3);
        $this->second[] = $this->random(1000, 3);
        $this->second[] = $this->random(1000, 3);
        $this->second[] = $this->random(1000, 3);
        $this->lastTwoDigit[] = $this->random(100, 2);

        Session::put('rewards', [
            'top' => $this->top,
            'neighbor' => $this->neighbor,
            'second' => $this->second,
            'lastTwoDigit' => $this->lastTwoDigit
        ]);

        Session::put('display', [
            'top' => implode(" ", $this->top),
            'neighbor' => implode(" ", $this->neighbor),
            'second' => implode(" ", $this->second),
            'lastTwoDigit' => implode(" ", $this->lastTwoDigit)
        ]);

        return redirect('lottery');
    }

    public function find(Request $request)
    {
        $lotNum = (string)$request->input('lotNum');

        if (!Session::get('rewards')) return redirect('lottery')->with('failed', 'ยังไม่ประกาศผลรางวัล');

        $corrects = $this->mapRewards($lotNum);

        if (empty($corrects)) return redirect('lottery')->with('failed', 'เสียใจด้วยคุณยังไม่ถูกรางวัลรอบหน้าเริ่มใหม่นะ');

        return redirect('lottery')->with('congrat', "เลข $lotNum ถูกรางวัล " . implode(", ", $corrects));
    }

    private function mapRewards($lotNum)
    {

        $maps = [];
        if (in_array($lotNum, Session::get('rewards')['top'])) {
            $maps[] = 'รางวัลที่ 1';
        }

        if (in_array($lotNum, Session::get('rewards')['neighbor'])) {
            $maps[] = 'รางวัลเลขข้างเคียงรางวัลที่ 1';
        }

        if (in_array($lotNum, Session::get('rewards')['second'])) {
            $maps[] = 'รางวัลที่ 2';
        }

        if (in_array(substr($lotNum, 1, 2), Session::get('rewards')['lastTwoDigit'])) {
            $maps[] = 'เลขท้าย 2 ตัว';
        }

        return $maps;
    }



    private function random($value, $digits)
    {
        $reward = $this->pad(rand(1, $value), $digits);

        while (isset($this->out[$reward])) {
            $this->out[$reward] = true;
        }

        return $reward;
    }

    private function pad($value, $digits)
    {
        return str_pad($value, $digits, "0", STR_PAD_LEFT);
    }
}
