<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function startTransaction(Request $request)
    {
        // Lưu giao dịch vào session
        $transaction = [
            'transaction_id' => uniqid(),
            'amount' => $request->amount,
            'receiver_account' => $request->receiver_account,
            'status' => 'pending'
        ];
        session()->put('transaction', $transaction);

        return response()->json([
            'message' => 'Giao dịch đã bắt đầu và được lưu trữ trong phiên',
            'transaction' => $transaction
        ]);
    }

    public function confirmTransaction()
    {
        // Cập nhật trạng thái
        $transaction = session()->get('transaction');
        session()->put('transaction.status', 'confirmed');
        $transaction['status'] = 'confirmed'; // Cập nhật trạng thái

        return response()->json([
            'message' => 'Giao dịch đã được xác nhận',
            'transaction' => $transaction
        ]);
    }

    public function completeTransaction()
    {
        // Lưu vào DB
        $transaction = session()->get('transaction');
        Transaction::create([
            'transaction_id' => $transaction['transaction_id'],
            'amount' => $transaction['amount'],
            'receiver_account' => $transaction['receiver_account'],
            'status' => 'success'
        ]);

        // Xóa session
        session()->forget('transaction');
        $transaction['status'] = 'success'; // Cập nhật trạng thái

        return response()->json([
            'message' => 'Giao dịch đã hoàn tất và được lưu',
            'transaction' => $transaction
        ]);
    }

    public function cancelTransaction()
    {
        // Lấy giao dịch trước khi hủy
        $transaction = session()->get('transaction');

        // Xóa session
        session()->forget('transaction');
        $transaction['status'] = 'canceled'; // Cập nhật trạng thái

        return response()->json([
            'message' => 'Giao dịch đã bị hủy',
            'transaction' => $transaction
        ]);
    }
}
