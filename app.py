from flask import Flask, render_template, request
from pymongo import MongoClient

app = Flask(__name__)

# Connect to MongoDB
client = MongoClient('mongodb://localhost:27017/')
db = client['attendance_db']  # Change to your database name
students_collection = db['students']  # Change to your collection name

@app.route('/')
def home():
    return render_template('search.html')

@app.route('/search', methods=['POST'])
def search():
    reg_no = request.form['reg_no']
    
    if reg_no.isdigit() and len(reg_no) == 12:
        student = students_collection.find_one({'reg_no': reg_no})
        return render_template('result.html', student=student)
    return render_template('result.html', student=None)

if __name__ == '__main__':
    app.run(debug=True)
