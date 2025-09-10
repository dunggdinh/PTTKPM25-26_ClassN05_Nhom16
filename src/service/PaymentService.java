package service;

import entity.Order;

public class PaymentService {
    public boolean processPayment(Order order, String method) {
        if ("COD".equals(method) || "ATM".equals(method) || "CARD".equals(method) || "EWALLET".equals(method)) {
            order.setStatus("PAID");
            return true;
        }
        return false; 
    }
}