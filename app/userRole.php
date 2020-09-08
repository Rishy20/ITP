<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userRole extends Model
{
    protected $fillable = [
      'Role_name','description','addUser','viewUser','updateUser','deleteUser',
      'inactivateUser','addUserRole','viewUserRole','updateUserRole','deleteUserRole','addProduct',
      'viewProduct','updateProduct','deleteProduct','showCostPrice','editQuantity','editPrice','printbarcodes',
      'exportProducts','addStaff','viewStaff','updateStaff','deleteStaff','edit_staff_attendance','mark_staff_attendance',
      'exportStaff','addCustomer','viewCustomer','updateCustomer','deleteCustomer','editLoyaltyPoints',
      'exportCustomers','addVendor','viewVendor','updateVendor','deleteVendor','exportVendors','addInventory',
      'viewInventory','updateInventory','deleteInventory','exportInventories','newInventoryCount',
      'editInventoryCount','viewInventoryCount','printInventoryCount','setInventoryCountCompleted',
      'deleteInventoryCount','inventoryTransfer','editInventoryTransfer','deleteInventoryTransfer',
      'addExpense','viewExpense','updateExpense','deleteExpense','addVoucher','viewVoucher','updateVoucher',
      'deleteVoucher','exportVoucher','addLoyalty','viewLoyalty','updateLoyalty','deleteLoyalty','exportLoyalty',
      'createPurchaseOrder','viewPurchaseOrder','updatePurchaseOrder','deletePurchaseOrder','printPurchaseInvoice',
      'exportPurchaseOrder','generateGRN','makeSalaryPayment','viewSalaryPayment','updateSalaryPayment',
      'deleteSalaryPayment','printSalaryPaymentInvoice','makeVendorPayment','viewVendorPayment','updateVendorPayment',
      'deleteVendorPayment','printVendorPaymentInvoice','processSale','accessBackend','openRegister','closeRegister','retrieveSale',
      'parkSale','suspendSale','giveDiscount','printDayEndReport','viewSale','updateSale','deleteSale',
      'viewProfit','deleteSuspendedSales','addbankAccounts','viewbankAccounts','updatebankAccounts','deletebankAccounts',
      'createPromotions','viewPromotions','updatePromotions','deletePromotions','removeProductsFromPromotion',
      'viewPromotionSummary','printPromotionSummaryReport','addService','viewService','updateService','deleteService',
      'exchangeProducts','viewExchange','updateExchange','deleteExchange','productReport','categoriesReport',
      'employeeReport','attendanceReport','bankAccountReport','salaryReport','commissionReport','customersReport',
      'salesReport','balanceChart','expensesReport','voucherReport','inventoryReport','loyaltyReport',
      'profitReport','paymentReport','purchasesReport','vendorsReport','serviceReport','stockTransferReport',
      'viewDashboardStatistics'
    ];

    protected $table = 'user_roles';
}
