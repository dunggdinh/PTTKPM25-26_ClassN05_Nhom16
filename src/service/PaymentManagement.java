package service;

import entity.Payment;
import entity.PaymentGateway;
import entity.PaymentMethod;

import java.util.ArrayList;
import java.util.List;

public class PaymentManagement {
    private List<Payment> payments = new ArrayList<>();
    private PaymentGateway gateway;
    private List<PaymentMethod> availableMethods = new ArrayList<>();

    public void createPayment(String orderID, String customerID, double amount, String methodID) {}
    public void processPayment(String paymentID) {}
    public void refundPayment(String paymentID, String reason) {}
    public List<Payment> getPaymentHistory(String customerID) { return new ArrayList<>(); }
    public List<PaymentMethod> listAvailableMethods() { return new ArrayList<>(availableMethods); }
}