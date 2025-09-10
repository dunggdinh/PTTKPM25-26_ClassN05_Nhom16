package entity;

public class SupportAgent extends User {
    private int level;

    public SupportAgent(String email, String password, String fullName, String phone, String status, int level) {
        super(email, password, fullName, phone, status);
        this.level = level;
    }

    public int getLevel() { return level; }
    public void setLevel(int level) { this.level = level; }
}