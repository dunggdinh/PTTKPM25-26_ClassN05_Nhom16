package service;

import entity.Order;

import java.util.ArrayList;
import java.util.List;

public class OrderManagement {
    private List<Order> orders = new ArrayList<>();
    private List<Order> completedOrders = new ArrayList<>();
    private List<Order> canceledOrders = new ArrayList<>();

    public List<Order> viewOrders(String status) { return new ArrayList<>(); }
    public void confirmOrder(String orderID) {}
    public void updateOrderStatus(String orderID, String newStatus) {}
    public void cancelOrder(String orderID) {}
    public void processReturnOrder(String orderID) {}
    public Order getOrderDetail(String orderID) { return null; }
    public void searchOrders(Object criteria) {}
    public void assignShipment(String orderID, Object shipmentInfo) {}
    public void trackOrder(String orderID) {}
    public void refundOrder(String orderID) {}
    public void printInvoice(String orderID) {}
}