#! C:\\Users\\harsh\\AppData\\Local\\Microsoft\\WindowsApps\\PythonSoftwareFoundation.Python.3.9_qbz5n2kfra8p0
import sys
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
import pandas as pd
from matplotlib import pyplot
import matplotlib.pyplot as plt

from sklearn.model_selection import train_test_split
from sklearn.model_selection import cross_val_score
from sklearn.model_selection import StratifiedKFold
from sklearn.metrics import classification_report
from sklearn.metrics import confusion_matrix
from sklearn.metrics import accuracy_score
from sklearn.linear_model import LogisticRegression
from sklearn.tree import DecisionTreeClassifier
from sklearn.neighbors import KNeighborsClassifier
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis
from sklearn.naive_bayes import GaussianNB
from sklearn.svm import SVC

#chk_emp_no =101    # remind nikhil to take value from html
chk_emp_no = int(sys.argv[1])
#print(int(chk_emp_no )- 97)           # checking input / output and datapassing through file

emp_survey = pd.read_csv(r'C:\Users\harsh\OneDrive\Desktop\be-project-ml-dump\employee_survey_data.csv')
general_data = pd.read_csv(r'C:\Users\harsh\OneDrive\Desktop\be-project-ml-dump\general_data.csv')
manager_survey = pd.read_csv(r'C:\Users\harsh\OneDrive\Desktop\be-project-ml-dump\manager_survey_data.csv')
intime = pd.read_csv(r'C:\Users\harsh\OneDrive\Desktop\be-project-ml-dump\in_time.csv')
outtime = pd.read_csv(r'C:\Users\harsh\OneDrive\Desktop\be-project-ml-dump\out_time.csv')

emp_manager_survey_ = pd.merge(emp_survey,manager_survey,on ='EmployeeID')
result = pd.merge(general_data,emp_manager_survey_,on = 'EmployeeID')
tp = result.head(100)
print(tp)
null_check=result.isnull()
print(result.info())
result=result.fillna({
        'NumCompaniesWorked':result['NumCompaniesWorked'].mean(),
        'TotalWorkingYears':result['TotalWorkingYears'].mean(),
        'EnvironmentSatisfaction':result['EnvironmentSatisfaction'].mean(),
        'JobSatisfaction':result['JobSatisfaction'].mean(),
        'WorkLifeBalance':result['WorkLifeBalance'].mean()
        
        })
print(result.info())
dum=result.isnull()
transponse = intime.T
"""
# iterating the columns 
for col in result.columns: 
    print(col) 
"""
entire_df = pd.DataFrame(result,columns=['EmployeeID','Age','DistanceFromHome','Gender'
                                    ,'Education','EducationField','Department','StandardHours'
                                    ,'Attrition','BusinessTravel','MaritalStatus'
                                    ,'NumCompaniesWorked'
                                    ,'JobLevel','JobRole','MonthlyIncome','PercentSalaryHike'
                                    ,'StockOptionLevel','TotalWorkingYears','TrainingTimesLastYear'
                                    ,'YearsAtCompany'
                                    ,'YearsSinceLastPromotion','YearsWithCurrManager'
                                    ,'EnvironmentSatisfaction','JobSatisfaction'
                                    ,'WorkLifeBalance','JobInvolvement','PerformanceRating'])

converted_df = entire_df.copy(deep=True)

# converting all categorical data into numeric
"""
print(converted_df['Gender'].value_counts())  
print(converted_df['EducationField'].value_counts())  
print(converted_df['Department'].value_counts())  
print(converted_df['Attrition'].value_counts())  
print(converted_df['BusinessTravel'].value_counts())  
print(converted_df['MaritalStatus'].value_counts())  
print(converted_df['JobRole'].value_counts())  
"""
mapping_dictionary_gender ={"Gender":{"Male":0,"Female":1}} 
mapping_dictionary_EducationField ={"EducationField":
                                        {"Life Sciences":1,"Medical":2,"Marketing":3,
                                                      "Technical Degree":4,"Human Resources":5,
                                                      "Other":0
                                                     }} 
mapping_dictionary_Department ={"Department":
                                    {"Research & Development":1,"Sales":2,"Human Resources":3                                             
                                                     }} 
mapping_dictionary_Attrition ={"Attrition":
                                        {"Yes":1,"No":0    
                                                      }} 
mapping_dictionary_BusinessTravel ={"BusinessTravel":
                                        {"Travel_Rarely":1, "Travel_Frequently":2,"Non-Travel":0,
                                                      }} 
mapping_dictionary_MaritalStatus ={"MaritalStatus":
                                        {"Single":1, "Married":2,"Divorced":3,
                                                      }} 
mapping_dictionary_JobRole ={"JobRole":
                                        {"Sales Executive":1, "Research Scientist":2,
                                         "Laboratory Technician":3,"Manufacturing Director":4,
                                         "Healthcare Representative":5,"Manager":6,
                                         "Sales Representative":7,"Research Director":8,
                                         "Human Resources":9,
                                                      }} 

    
converted_df.replace(mapping_dictionary_gender, inplace=True)
converted_df.replace(mapping_dictionary_EducationField, inplace=True)
converted_df.replace(mapping_dictionary_Department, inplace=True)
converted_df.replace(mapping_dictionary_Attrition, inplace=True)
converted_df.replace(mapping_dictionary_BusinessTravel, inplace=True)
converted_df.replace(mapping_dictionary_MaritalStatus, inplace=True)
converted_df.replace(mapping_dictionary_JobRole, inplace=True)


df1 = converted_df.copy(deep = True)

data = df1[['Age','DistanceFromHome','Gender'
           ,'Education','EducationField','Department','StandardHours'
           ,'Attrition','BusinessTravel','MaritalStatus'
           ,'NumCompaniesWorked'
           ,'JobLevel','JobRole','MonthlyIncome','PercentSalaryHike'
           ,'StockOptionLevel','TotalWorkingYears','TrainingTimesLastYear'
           ,'YearsAtCompany'
           ,'YearsSinceLastPromotion','YearsWithCurrManager'
           ,'EnvironmentSatisfaction','JobSatisfaction'
           ,'WorkLifeBalance','JobInvolvement']]
output = df1['PerformanceRating']


predict = pd.DataFrame()
predict = converted_df[(converted_df.EmployeeID== chk_emp_no)]
predict=predict.drop(['EmployeeID'], axis=1)
predict=predict.drop(['PerformanceRating'], axis=1)

# cleaning done

x_train, x_test, y_train, y_test = train_test_split(data, output, test_size=0.30, random_state=1)


###########################    LOGICAL REGRESSION    ##############################################

# Fitting the logistic regression to the training set
from sklearn.linear_model import LogisticRegression
classifier = LogisticRegression(random_state = 0)
classifier.fit(x_train, y_train)

# Predicitng the test reaults
#y_pred = classifier.predict(x_test)
#cm = confusion_matrix(y_test, y_pred)


prediction = pd.DataFrame(columns = ['PerformanceRating'])

prediction['PerformanceRating'] = classifier.predict(predict)
print(prediction['PerformanceRating'][0])


'''
x_train, x_test, y_train, y_test = train_test_split(data, output, test_size=0.30, random_state=1)
"""
models = []
models.append(('LR', LogisticRegression(solver='liblinear', multi_class='ovr')))
models.append(('LDA', LinearDiscriminantAnalysis()))
models.append(('KNN', KNeighborsClassifier()))
models.append(('CART', DecisionTreeClassifier()))
models.append(('NB', GaussianNB()))
models.append(('SVM', SVC(gamma='auto')))

# evaluate each model in turn
results = []
names = []
for name, model in models:
	kfold = StratifiedKFold(n_splits=10, random_state=1, shuffle=True)
	cv_results = cross_val_score(model, X_train, Y_train, cv=kfold, scoring='accuracy')
	results.append(cv_results)
	names.append(name)
	print('%s: %f (%f)' % (name, cv_results.mean(), cv_results.std()))
print('Done!')
"""

###########################    LOGICAL REGRESSION    ##############################################

# Fitting the logistic regression to the training set
from sklearn.linear_model import LogisticRegression
classifier = LogisticRegression(random_state = 0)
classifier.fit(x_train, y_train)

# Predicitng the test reaults
y_pred = classifier.predict(x_test)


cm = confusion_matrix(y_test, y_pred)

prediction = pd.DataFrame(columns = ['PerformanceRating'])

prediction['PerformanceRating'] = classifier.predict(predict)
#print("########  prediction ##############")
#print(prediction)
print(prediction['PerformanceRating'][0])
#print(accuracy_score(y_test,y_pred))



###########################   decision tree   ######################################
"""
from sklearn.tree import DecisionTreeClassifier
dtree = DecisionTreeClassifier(criterion='gini') #criterion = entopy, gini
dtree.fit(x_train, y_train)
dtreepred = dtree.predict(x_test)

print(confusion_matrix(y_test, dtreepred))
print(round(accuracy_score(y_test, dtreepred),2)*100)
"""
#######################  Random Forest      ###############################################
"""
from sklearn.ensemble import RandomForestClassifier
rfc = RandomForestClassifier(n_estimators = 200)#criterion = entopy,gini
rfc.fit(x_train, y_train)
rfcpred = rfc.predict(x_test)

print(confusion_matrix(y_test, rfcpred ))
print(round(accuracy_score(y_test, rfcpred),2)*100)
#result.to_csv('C:\\Users\\nikhi\\Desktop\\be-project-ml-dump\\general_data-x-employee_survey-x-manager_survey.csv',index=False)
"""
'''