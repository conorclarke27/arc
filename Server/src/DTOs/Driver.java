package DTOs;

import java.util.Objects;

/**
 *
 * @author Administrator
 */
public class Driver extends User {
    private String car;
    private double est_pay;
    private String available; 

    public Driver(String car, double est_pay, String available, int user_id, String name, int age, String gender, String email, String password, String college, String description, String user_type, int location_id) {
        super(user_id, name, age, gender, email, password, college, description, user_type, location_id);
        this.car = car;
        this.est_pay = est_pay;
        this.available = available;
    }

    public Driver(String car, double est_pay, String available, int user_id, String name, int age, String gender, String email, String college, String description, String user_type, int location_id) {
        super(user_id, name, age, gender, email, college, description, user_type, location_id);
        this.car = car;
        this.est_pay = est_pay;
        this.available = available;
    }

    public Driver() {
        this.car = "";
        this.est_pay = 0.0;
        this.available = "";
    }

    public String getCar() {
        return car;
    }

    public void setCar(String car) {
        this.car = car;
    }

    public double getEst_pay() {
        return est_pay;
    }

    public void setEst_pay(double est_pay) {
        this.est_pay = est_pay;
    }

    public String getAvailable() {
        return available;
    }

    public void setAvailable(String available) {
        this.available = available;
    }

    @Override
    public String toString() {
        return "Driver{" + "car=" + car + ", est_pay=" + est_pay + ", available=" + available + '}';
    }

    @Override
    public int hashCode() {
        int hash = 7;
        hash = 29 * hash + Objects.hashCode(this.car);
        hash = 29 * hash + (int) (Double.doubleToLongBits(this.est_pay) ^ (Double.doubleToLongBits(this.est_pay) >>> 32));
        hash = 29 * hash + Objects.hashCode(this.available);
        return hash;
    }

    @Override
    public boolean equals(Object obj) {
        if (this == obj)
        {
            return true;
        }
        if (obj == null)
        {
            return false;
        }
        if (getClass() != obj.getClass())
        {
            return false;
        }
        final Driver other = (Driver) obj;
        if (Double.doubleToLongBits(this.est_pay) != Double.doubleToLongBits(other.est_pay))
        {
            return false;
        }
        if (!Objects.equals(this.car, other.car))
        {
            return false;
        }
        if (!Objects.equals(this.available, other.available))
        {
            return false;
        }
        return true;
    }
    
}