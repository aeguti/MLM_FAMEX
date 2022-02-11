<?php
namespace App\Http\Controllers;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserExtra;
use Carbon\Carbon;
use Illuminate\Http\Request;
class CronController extends Controller
{
    public function cron()
    {
        $gnl = GeneralSetting::first();
        $gnl->last_cron = Carbon::now()->toDateTimeString();
        $gnl->save();
        if ($gnl->matching_bonus_time == 'daily') {
            $day = Date('H');
            if (strtolower($day) != $gnl->matching_when) {
                return '1';
            }
        }
        if ($gnl->matching_bonus_time == 'weekly') {
            $day = Date('D');
            if (strtolower($day) != $gnl->matching_when) {
                return '2';
            }
        }
        if ($gnl->matching_bonus_time == 'monthly') {
            $day = Date('d');
            if (strtolower($day) != $gnl->matching_when) {
                return '3';
            }
        }
        $gnl->last_paid = Carbon::now()->toDateString();
        $gnl->save();
        $eligibleUsers = UserExtra::where('bv_left', '>=', $gnl->total_bv)->where('bv_right', '>=', $gnl->total_bv)->with('user')->get();
            foreach ($eligibleUsers as $i=>$uex) {
                $user = $uex->user;
                $weak = $uex->bv_left < $uex->bv_right ? $uex->bv_left : $uex->bv_right;
                $weaker = $weak < $gnl->max_bv ? $weak : $gnl->max_bv;
                $bv_price = $gnl->bv_price / $gnl->total_bv;
                $bonus = $weaker * $bv_price;
                // add balance to User
                $user->balance += $bonus;
                $user->save();
                $trx = new Transaction();
                $trx->user_id = $user->id;
                $trx->amount = $bonus;
                $trx->charge = 0;
                $trx->trx_type = '+';
                $trx->post_balance = $user->balance;
                $trx->remark = 'binary_commission';
                $trx->trx = getTrx();
                $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $weaker . ' BV.';
                $trx->save();
                $paidbv = $weaker;
                if ($gnl->cary_flash == 0) {
                    $bv['setl'] = $uex->bv_left - $paidbv;
                    $bv['setr'] = $uex->bv_right - $paidbv;
                    $bv['paid'] = $paidbv;
                    $bv['lostl'] = 0;
                    $bv['lostr'] = 0;
                }
                if ($gnl->cary_flash == 1) {
                    $bv['setl'] = $uex->bv_left - $weak;
                    $bv['setr'] = $uex->bv_right - $weak;
                    $bv['paid'] = $paidbv;
                    $bv['lostl'] = $weak - $paidbv;
                    $bv['lostr'] = $weak - $paidbv;
                }
                if ($gnl->cary_flash == 2) {
                    $bv['setl'] = 0;
                    $bv['setr'] = 0;
                    $bv['paid'] = $paidbv;
                    $bv['lostl'] = $uex->bv_left - $paidbv;
                    $bv['lostr'] = $uex->bv_right - $paidbv;
                }
                $uex->bv_left = $bv['setl'];
                $uex->bv_right = $bv['setr'];
                $uex->save();
                if ($bv['paid'] != 0) {
                    createBVLog($user->id, 1, $bv['paid'], 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
                    createBVLog($user->id, 2, $bv['paid'], 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
                }
                if ($bv['lostl'] != 0) {
                    createBVLog($user->id, 1, $bv['lostl'], 'Flush ' . $bv['lostl'] . ' BV after Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
                }
                if ($bv['lostr'] != 0) {
                    createBVLog($user->id, 2, $bv['lostr'], 'Flush ' . $bv['lostr'] . ' BV after Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
                }
                notify($user, 'matching_bonus', [
                    'amount' => $bonus,
                    'currency' => $gnl->cur_text,
                    'paid_bv' => $weaker,
                    'post_balance' => $user->balance,
                    'trx' =>  $trx->trx,
                ]);
            }
            return '---';
    }
}