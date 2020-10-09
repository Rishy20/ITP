<?php

namespace App\Http\Controllers;

use App\userRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = userRole::all();

        return view ('User.allUserRole',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.addUserRole');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        userRole::create($request->all());
        Session::put('message', 'Success!');
        return redirect('/role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = userRole::find($id);


        return view('User.editUserRole',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $userRole = userRole::findOrFail($id);
        $userRole->Role_name = $request->Role_name;
        $userRole->description = $request->description;
        $userRole->addUser = $request->addUser=== null?0:1;
        $userRole->viewUser = $request->viewUser=== null?0:1;
        $userRole->updateUser = $request->updateUser=== null?0:1;
        $userRole->deleteUser = $request->deleteUser=== null?0:1;
        $userRole->inactivateUser = $request->inactivateUser=== null?0:1;
        $userRole->addUserRole = $request->addUserRole=== null?0:1;
        $userRole->viewUserRole = $request->viewUserRole=== null?0:1;
        $userRole->updateUserRole = $request->updateUserRole=== null?0:1;
        $userRole->deleteUserRole = $request->deleteUserRole=== null?0:1;
        $userRole->addProduct = $request->addProduct=== null?0:1;
        $userRole->viewProduct = $request->viewProduct=== null?0:1;
        $userRole->updateProduct = $request->updateProduct=== null?0:1;
        $userRole->deleteProduct = $request->deleteProduct=== null?0:1;
        $userRole->showCostPrice = $request->showCostPrice=== null?0:1;
        $userRole->editQuantity = $request->editQuantity=== null?0:1;
        $userRole->editPrice = $request->editPrice=== null?0:1;
        $userRole->printbarcodes = $request->printbarcodes=== null?0:1;
        $userRole->exportProducts = $request->exportProducts=== null?0:1;
        $userRole->addStaff = $request->addStaff=== null?0:1;
        $userRole->viewStaff = $request->viewStaff=== null?0:1;
        $userRole->updateStaff = $request->updateStaff=== null?0:1;
        $userRole->deleteStaff = $request->deleteStaff=== null?0:1;
        $userRole->edit_staff_attendance = $request->edit_staff_attendance=== null?0:1;
        $userRole->mark_staff_attendance = $request->mark_staff_attendance=== null?0:1;
        $userRole->exportStaff = $request->exportStaff=== null?0:1;
        $userRole->addCustomer = $request->addCustomer=== null?0:1;
        $userRole->viewCustomer = $request->viewCustomer=== null?0:1;
        $userRole->updateCustomer = $request->updateCustomer=== null?0:1;
        $userRole->deleteCustomer = $request->deleteCustomer=== null?0:1;
        $userRole->editLoyaltyPoints = $request->editLoyaltyPoints=== null?0:1;
        $userRole->exportCustomers = $request->exportCustomers=== null?0:1;
        $userRole->addVendor = $request->addVendor=== null?0:1;
        $userRole->viewVendor = $request->viewVendor=== null?0:1;
        $userRole->updateVendor = $request->updateVendor=== null?0:1;
        $userRole->deleteVendor = $request->deleteVendor=== null?0:1;
        $userRole->exportVendors = $request->exportVendors=== null?0:1;
        $userRole->addInventory = $request->addInventory=== null?0:1;
        $userRole->viewInventory = $request->viewInventory=== null?0:1;
        $userRole->updateInventory = $request->updateInventory=== null?0:1;
        $userRole->deleteInventory = $request->deleteInventory=== null?0:1;
        $userRole->exportInventories = $request->exportInventories=== null?0:1;
        $userRole->newInventoryCount = $request->newInventoryCount=== null?0:1;
        $userRole->editInventoryCount = $request->editInventoryCount=== null?0:1;
        $userRole->viewInventoryCount = $request->viewInventoryCount=== null?0:1;
        $userRole->printInventoryCount = $request->printInventoryCount=== null?0:1;
        $userRole->setInventoryCountCompleted = $request->setInventoryCountCompleted=== null?0:1;
        $userRole->deleteInventoryCount = $request->deleteInventoryCount=== null?0:1;
        $userRole->inventoryTransfer = $request->inventoryTransfer=== null?0:1;
        $userRole->editInventoryTransfer = $request->editInventoryTransfer=== null?0:1;
        $userRole->deleteInventoryTransfer = $request->deleteInventoryTransfer=== null?0:1;
        $userRole->addExpense = $request->addExpense=== null?0:1;
        $userRole->viewExpense = $request->viewExpense=== null?0:1;
        $userRole->updateExpense = $request->updateExpense=== null?0:1;
        $userRole->deleteExpense = $request->deleteExpense=== null?0:1;
        $userRole->addVoucher = $request->addVoucher=== null?0:1;
        $userRole->viewVoucher = $request->viewVoucher=== null?0:1;
        $userRole->updateVoucher = $request->updateVoucher=== null?0:1;
        $userRole->deleteVoucher = $request->deleteVoucher=== null?0:1;
        $userRole->exportVoucher = $request->exportVoucher=== null?0:1;
        $userRole->addLoyalty = $request->addLoyalty=== null?0:1;
        $userRole->viewLoyalty = $request->viewLoyalty=== null?0:1;
        $userRole->updateLoyalty = $request->updateLoyalty=== null?0:1;
        $userRole->deleteLoyalty = $request->deleteLoyalty=== null?0:1;
        $userRole->exportLoyalty = $request->exportLoyalty=== null?0:1;
        $userRole->createPurchaseOrder = $request->createPurchaseOrder=== null?0:1;
        $userRole->viewPurchaseOrder = $request->viewPurchaseOrder=== null?0:1;
        $userRole->updatePurchaseOrder = $request->updatePurchaseOrder=== null?0:1;
        $userRole->deletePurchaseOrder = $request->deletePurchaseOrder=== null?0:1;
        $userRole->exportPurchaseOrder = $request->exportPurchaseOrder=== null?0:1;
        $userRole->printPurchaseInvoice = $request->printPurchaseInvoice=== null?0:1;
        $userRole->generateGRN = $request->generateGRN=== null?0:1;
        $userRole->makeSalaryPayment = $request->makeSalaryPayment=== null?0:1;
        $userRole->viewSalaryPayment = $request->viewSalaryPayment=== null?0:1;
        $userRole->updateSalaryPayment = $request->updateSalaryPayment=== null?0:1;
        $userRole->deleteSalaryPayment = $request->deleteSalaryPayment=== null?0:1;
        $userRole->printSalaryPaymentInvoice = $request->printSalaryPaymentInvoice=== null?0:1;
        $userRole->makeVendorPayment = $request->makeVendorPayment=== null?0:1;
        $userRole->viewVendorPayment = $request->viewVendorPayment=== null?0:1;
        $userRole->updateVendorPayment = $request->updateVendorPayment=== null?0:1;
        $userRole->deleteVendorPayment = $request->deleteVendorPayment=== null?0:1;
        $userRole->printVendorPaymentInvoice = $request->printVendorPaymentInvoice=== null?0:1;
        $userRole->processSale = $request->processSale=== null?0:1;
        $userRole->accessBackend = $request->accessBackend=== null?0:1;
        $userRole->openRegister = $request->openRegister=== null?0:1;
        $userRole->closeRegister = $request->closeRegister=== null?0:1;
        $userRole->retrieveSale = $request->retrieveSale=== null?0:1;
        $userRole->parkSale = $request->parkSale=== null?0:1;
        $userRole->suspendSale = $request->suspendSale=== null?0:1;
        $userRole->giveDiscount = $request->giveDiscount=== null?0:1;
        $userRole->printDayEndReport = $request->printDayEndReport=== null?0:1;
        $userRole->viewSale = $request->viewSale=== null?0:1;
        $userRole->updateSale = $request->updateSale=== null?0:1;
        $userRole->deleteSale = $request->deleteSale=== null?0:1;
        $userRole->viewProfit = $request->viewProfit=== null?0:1;
        $userRole->deleteSuspendedSales = $request->deleteSuspendedSales=== null?0:1;
        $userRole->addbankAccounts = $request->addbankAccounts=== null?0:1;
        $userRole->viewbankAccounts = $request->viewbankAccounts=== null?0:1;
        $userRole->updatebankAccounts = $request->updatebankAccounts=== null?0:1;
        $userRole->deletebankAccounts = $request->deletebankAccounts=== null?0:1;
        $userRole->createPromotions = $request->createPromotions=== null?0:1;
        $userRole->viewPromotions = $request->viewPromotions=== null?0:1;
        $userRole->updatePromotions = $request->updatePromotions=== null?0:1;
        $userRole->deletePromotions = $request->deletePromotions=== null?0:1;
        $userRole->removeProductsFromPromotion = $request->removeProductsFromPromotion=== null?0:1;
        $userRole->viewPromotionSummary = $request->viewPromotionSummary=== null?0:1;
        $userRole->printPromotionSummaryReport = $request->printPromotionSummaryReport=== null?0:1;
        $userRole->addService = $request->addService=== null?0:1;
        $userRole->viewService = $request->viewService=== null?0:1;
        $userRole->updateService = $request->updateService=== null?0:1;
        $userRole->deleteService = $request->deleteService=== null?0:1;
        $userRole->exchangeProducts = $request->exchangeProducts=== null?0:1;
        $userRole->viewExchange = $request->viewExchange=== null?0:1;
        $userRole->updateExchange = $request->updateExchange=== null?0:1;
        $userRole->deleteExchange = $request->deleteExchange=== null?0:1;
        $userRole->productReport = $request->productReport=== null?0:1;
        $userRole->categoriesReport = $request->categoriesReport=== null?0:1;
        $userRole->employeeReport = $request->employeeReport=== null?0:1;
        $userRole->attendanceReport = $request->attendanceReport=== null?0:1;
        $userRole->bankAccountReport = $request->bankAccountReport=== null?0:1;
        $userRole->salaryReport = $request->salaryReport=== null?0:1;
        $userRole->commissionReport = $request->commissionReport=== null?0:1;
        $userRole->customersReport = $request->customersReport=== null?0:1;
        $userRole->salesReport = $request->salesReport=== null?0:1;
        $userRole->balanceChart = $request->balanceChart=== null?0:1;
        $userRole->expensesReport = $request->expensesReport=== null?0:1;
        $userRole->voucherReport = $request->voucherReport=== null?0:1;
        $userRole->inventoryReport = $request->inventoryReport=== null?0:1;
        $userRole->loyaltyReport = $request->loyaltyReport=== null?0:1;
        $userRole->profitReport = $request->profitReport=== null?0:1;
        $userRole->paymentReport = $request->paymentReport=== null?0:1;
        $userRole->purchasesReport = $request->purchasesReport=== null?0:1;
        $userRole->vendorsReport = $request->vendorsReport=== null?0:1;
        $userRole->serviceReport = $request->serviceReport=== null?0:1;
        $userRole->stockTransferReport = $request->stockTransferReport=== null?0:1;
        $userRole->viewDashboardStatistics = $request->viewDashboardStatistics=== null?0:1;
        $userRole->save();
        $userRole = userRole::findOrFail($id);
        return redirect('/role');
        Session::put('message', 'Success!');
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $role = userRole::findOrFail($id);
         Session::put('message', 'Success!');

        $role->delete();
         return redirect()->back();
    }
}

