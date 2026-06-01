<?php
namespace App\Http\Controllers\Admin;

use App\Domain\Vat\Actions\UpdateVatRateAction;
use Illuminate\Http\JsonResponse;

class VatController
{
    public function __construct(
        private UpdateVatRateAction $action
    ) {}

    public function update(): JsonResponse
    {
        $this->action->execute();
        return response()->json(['message' => 'VAT rate updated successfully.']);
    }
}