package service;

import entity.Order;
import entity.OrderItem;
import entity.Product;
import entity.Voucher;
import entity.Inventory;
import entity.Address;
import java.util.ArrayList;
import java.util.List;
import java.util.UUID;
// import java.time.LocalDateTime;
import java.util.concurrent.Executors;
import java.util.concurrent.ScheduledExecutorService;
import java.util.concurrent.TimeUnit;
import java.util.stream.Collectors;

public class OrderService {
    private List<Order> orders = new ArrayList<>();
    private ProductService productService = new ProductService();

    public Order createOrder(UUID customerId, List<OrderItem> items, Address shippingAddress, Voucher voucher) {
        double total = 0.0;
        for (OrderItem item : items) {
            Product product = productService.getProductById(item.getProductId());
            if (product == null || product.getStock() < item.getQuantity()) {
                throw new RuntimeException("Sản phẩm không đủ hàng hoặc không tồn tại");
            }
            total += item.getSubtotal();
        }

        if (voucher != null && voucher.isActive() && total >= voucher.getMinOrderValue()) {
            total -= voucher.getValue();
            voucher.deactivate();
        }

        Order order = new Order(customerId, items, shippingAddress);
        order.setStatus("PENDING_PAYMENT");
        orders.add(order);

        for (OrderItem item : items) {
            Product product = productService.getProductById(item.getProductId());
            if (product != null) {
                product.setStock(product.getStock() - item.getQuantity());
            }
        }

        ScheduledExecutorService scheduler = Executors.newSingleThreadScheduledExecutor();
        scheduler.schedule(() -> {
            if ("PENDING_PAYMENT".equals(order.getStatus())) {
                order.setStatus("CANCELED");
                for (OrderItem item : items) {
                    Product product = productService.getProductById(item.getProductId());
                    if (product != null) {
                        product.setStock(product.getStock() + item.getQuantity());
                    }
                }
            }
            scheduler.shutdown();
        }, 15, TimeUnit.MINUTES);

        return order;
    }

    public void updateOrderStatus(UUID orderId, String newStatus) {
        Order order = orders.stream().filter(o -> o.getId().equals(orderId)).findFirst().orElse(null);
        if (order != null) {
            order.setStatus(newStatus);
        }
    }

    public List<Order> getOrdersByCustomerId(UUID customerId) {
        return orders.stream()
                .filter(o -> o.getCustomerId().equals(customerId))
                .collect(Collectors.toList());
    }

    public Order getOrderById(UUID orderId) {
        return orders.stream().filter(o -> o.getId().equals(orderId)).findFirst().orElse(null);
    }
}