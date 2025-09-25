package service;

import entity.Admin;
import entity.Customer;

import java.util.ArrayList;
import java.util.List;

public class UserManagement {
    private List<Customer> customers = new ArrayList<>();
    private List<Admin> admins = new ArrayList<>();

    public Customer getCustomerProfile(int customerID) { return null; }
    public void updateCustomerProfile(int customerID, Object newProfile) {}
    public void deleteCustomerProfile(int customerID) {}
    public void lockCustomerAccount(int userID) {}
    public void unlockCustomerAccount(int userID) {}
    public Admin getAdminProfile(int adminID) { return null; }
    public void updateAdminProfile(int adminID, Object newProfile) {}
    public void deleteAdminProfile(int adminID) {}
}