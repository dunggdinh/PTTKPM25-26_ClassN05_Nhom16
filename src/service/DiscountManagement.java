package service;

import entity.Discount;

import java.util.ArrayList;
import java.util.List;

public class DiscountManagement {
    private List<Discount> discountCodes = new ArrayList<>();
    private List<Discount> activeDiscounts = new ArrayList<>();
    private List<Discount> expiredDiscounts = new ArrayList<>();

    public void createDiscountCode(Discount discountCode) {}
    public void updateDiscountCode(String codeID, Object newInfo) {}
    public void deleteDiscountCode(String codeID) {}
    public List<Discount> listActiveDiscounts() { return new ArrayList<>(activeDiscounts); }
    public void expireDiscount(String codeID) {}
}