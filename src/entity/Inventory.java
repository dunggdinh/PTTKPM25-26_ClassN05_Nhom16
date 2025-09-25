package entity;

import java.util.Date;

public class Inventory {
    private int inventoryID;
    private String productID;
    private String warehouseName;
    private int stockAvailable;
    private int safetyStock;
    private String location;
    private Date lastUpdated;

    public Inventory(int inventoryID, String productID, String warehouseName, int stockAvailable, int safetyStock, String location) {
        this.inventoryID = inventoryID;
        this.productID = productID;
        this.warehouseName = warehouseName;
        this.stockAvailable = stockAvailable;
        this.safetyStock = safetyStock;
        this.location = location;
        this.lastUpdated = new Date();
    }

    public void updateStock(String productID, int quantity) {}
    public int checkStock(String productID) { return 0; }
    public void reserveStock(String productID, int quantity) {}
    public void alertLowStock(String productID) {}
    public void transferStock(int fromWarehouse, int toWarehouse, String productID, int quantity) {}

    public int getInventoryID() { return inventoryID; }
    public void setInventoryID(int inventoryID) { this.inventoryID = inventoryID; }
    public String getProductID() { return productID; }
    public void setProductID(String productID) { this.productID = productID; }
    public String getWarehouseName() { return warehouseName; }
    public void setWarehouseName(String warehouseName) { this.warehouseName = warehouseName; }
    public int getStockAvailable() { return stockAvailable; }
    public void setStockAvailable(int stockAvailable) { this.stockAvailable = stockAvailable; }
    public int getSafetyStock() { return safetyStock; }
    public void setSafetyStock(int safetyStock) { this.safetyStock = safetyStock; }
    public String getLocation() { return location; }
    public void setLocation(String location) { this.location = location; }
    public Date getLastUpdated() { return new Date(lastUpdated.getTime()); }
    public void setLastUpdated(Date lastUpdated) { this.lastUpdated = lastUpdated != null ? new Date(lastUpdated.getTime()) : new Date(); }
}